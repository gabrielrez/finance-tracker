<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        $attributes = request()->validate([
            'username' => ['required', 'max:28'],
            'email' => ['required', 'email', 'max:254', 'unique:users,email'],
            'password' => ['required', 'confirmed']
        ]);

        $user = User::create($attributes);

        // TODO: Implement a shared categories system accessible by all users
        $user->categories()->create([
            'name' => 'Default'
        ]);

        Auth::login($user);

        return redirect('/home');
    }



    public function login()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Oops, those credentials do not match'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/home');
    }



    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
