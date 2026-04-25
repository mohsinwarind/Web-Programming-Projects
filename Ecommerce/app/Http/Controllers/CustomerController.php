<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->get();
        $totalOrders = $orders->count();
        $totalSpent = $orders->sum('total_amount');
        $recentOrders = $orders->take(5);

        return view('customer.dashboard', compact('orders', 'totalOrders', 'totalSpent', 'recentOrders'));
    }

    public function viewOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        return view('customer.order-detail', compact('order'));
    }

    public function contactForm()
    {
        return view('customer.contact-form');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Contact::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return redirect()->route('home')->with('success', 'Your message has been sent successfully!');
    }
}
