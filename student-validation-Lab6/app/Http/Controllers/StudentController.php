<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    //
    public function create(){
    return view('students.create');
}
public function index()
{
    $students = Student::all();
    return view('students.index', compact('students'));
}
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|unique:students,email',
        'age' => 'required|integer|min:18|max:60',
        'password' => 'required|min:6',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',

    ]);
       // Handle file upload
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('students', 'public');
        $validated['image'] = $path;
    }

    // Hash password
    $validated['password'] = bcrypt($validated['password']);

    \App\Models\Student::create($validated);

    return redirect()->back()->with('success', 'Student created successfully!');
}
}
