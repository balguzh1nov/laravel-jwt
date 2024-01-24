<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        // Проверяем, авторизован ли пользователь, и если да, перенаправляем на профиль
        if (Auth::check()) {
            return redirect('/profile')->withErrors(['info' => 'You are already registered and logged in.']);
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Создание пользователя
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Создание профиля
        $user->profile()->create([
            'avatar' => 'default-avatar.jpg',
        ]);

        // Аутентификация пользователя
        Auth::login($user);

        return redirect('/profile')->with('success', 'Registration successful!');
    }

    public function showLoginForm()
{
    // Проверяем, авторизован ли пользователь
    if (Auth::check()) {
        return redirect('/profile')->withErrors(['info' => 'You are already logged in.']);
    }

    return view('auth.login');
}

    public function login(Request $request)
    {
        // Проверяем, авторизован ли пользователь, и если да, перенаправляем на профиль
        if (Auth::check()) {
            return redirect('/profile')->withErrors(['info' => 'You are already logged in.']);
        }

        // Валидация данных
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Попытка аутентификации
        if (Auth::attempt($validatedData)) {
            return redirect('/profile');
        }

        // Аутентификация не удалась
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout successful!');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
}
