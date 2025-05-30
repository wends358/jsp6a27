<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;


class AuthController extends Controller
{
    public function showRegisterForm() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Registration successful. Please login.');
    }

    public function showLoginForm() {
        return view('login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('products.index'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }

    public function productPage() {
    $products = Product::paginate(10);
    return view('products.index', ['products' => $products]);
}

    public function index() {
    $products = Product::paginate(10);
    return view('products.index', compact('products'));
}
}