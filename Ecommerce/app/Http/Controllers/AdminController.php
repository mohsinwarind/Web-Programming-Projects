<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalContacts = Contact::count();

        $recentOrders = Order::latest()->take(10)->with('user')->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'totalProducts',
            'totalContacts',
            'recentOrders'
        ));
    }

    public function customers()
    {
        return view('admin.customers');
    }

    public function getCustomers()
    {
        $users = User::where('role', 'user')->get();

        return DataTables::of($users)
            ->addColumn('total_orders', function ($user) {
                return $user->orders()->count();
            })
            ->addColumn('total_spent', function ($user) {
                return 'Rs. ' . number_format($user->orders()->sum('total_amount'), 2);
            })
            ->addColumn('join_date', function ($user) {
                return $user->created_at->format('M d, Y');
            })
            ->addColumn('action', function ($user) {
                return '<a href="' . route('admin.customer.detail', $user->id) . '" class="btn btn-sm btn-info">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function customerDetail($id)
    {
        $customer = User::findOrFail($id);
        $orders = $customer->orders()->latest()->get();
        $totalOrders = $orders->count();
        $totalSpent = $orders->sum('total_amount');

        return view('admin.customer-detail', compact('customer', 'orders', 'totalOrders', 'totalSpent'));
    }

    public function orders()
    {
        return view('admin.orders');
    }

    public function getOrders()
    {
        $orders = Order::with('user')->get();

        return DataTables::of($orders)
            ->addColumn('customer_name', function ($order) {
                return $order->user->name;
            })
            ->addColumn('customer_email', function ($order) {
                return $order->user->email;
            })
            ->addColumn('total', function ($order) {
                return 'Rs. ' . number_format($order->total_amount, 2);
            })
            ->addColumn('order_date', function ($order) {
                return $order->created_at->format('M d, Y H:i');
            })
            ->addColumn('status', function ($order) {
                $statusColors = [
                    'pending' => 'warning',
                    'processing' => 'info',
                    'shipped' => 'primary',
                    'delivered' => 'success',
                    'cancelled' => 'danger',
                ];
                $color = $statusColors[$order->status] ?? 'secondary';
                return '<span class="badge bg-' . $color . '">' . ucfirst($order->status) . '</span>';
            })
            ->addColumn('action', function ($order) {
                return '<a href="' . route('admin.order.detail', $order->id) . '" class="btn btn-sm btn-info">View</a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function orderDetail($id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($id);

        return view('admin.order-detail', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    public function products()
    {
        $categories = Category::all();
        return view('admin.products', compact('categories'));
    }

    public function getProducts()
    {
        $products = Product::with('category')->get();

        return DataTables::of($products)
            ->addColumn('category_name', function ($product) {
                return $product->category->name;
            })
            ->addColumn('price', function ($product) {
                return 'Rs. ' . number_format($product->price, 2);
            })
            ->addColumn('action', function ($product) {
                return '<a href="' . route('admin.product.edit', $product->id) . '" class="btn btn-sm btn-warning">Edit</a> ' .
                       '<form method="POST" action="' . route('admin.product.delete', $product->id) . '" style="display:inline;">
                           <input type="hidden" name="_token" value="' . csrf_token() . '">
                           <input type="hidden" name="_method" value="DELETE">
                           <button class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                       </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.create-product', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit-product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

    public function contacts()
    {
        $contacts = Contact::with('user')->latest()->paginate(20);
        return view('admin.contacts', compact('contacts'));
    }

    public function contactDetail($id)
    {
        $contact = Contact::with('user', 'replies.admin')->findOrFail($id);
        return view('admin.contact-detail', compact('contact'));
    }

    public function submitReply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validated = $request->validate([
            'message' => 'required|string|min:10',
        ]);

        Reply::create([
            'contact_id' => $contact->id,
            'admin_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Reply sent successfully!');
    }

    public function categories()
    {
        return view('admin.categories');
    }

    public function getCategories()
    {
        $categories = Category::all();

        return DataTables::of($categories)
            ->addColumn('products_count', function ($category) {
                return $category->products()->count();
            })
            ->addColumn('action', function ($category) {
                return '<a href="' . route('admin.category.edit', $category->id) . '" class="btn btn-sm btn-warning">Edit</a> ' .
                       '<form method="POST" action="' . route('admin.category.delete', $category->id) . '" style="display:inline;">
                           <input type="hidden" name="_token" value="' . csrf_token() . '">
                           <input type="hidden" name="_method" value="DELETE">
                           <button class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                       </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function createCategory()
    {
        return view('admin.create-category');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        Category::create($validated);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit-category', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }
}
