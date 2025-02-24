<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $validated['password'] = bcrypt($validated['password']);
    $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');

    $user = User::create($validated);

    return redirect()->route('login');
}

}
