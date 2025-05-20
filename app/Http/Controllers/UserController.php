<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $incomingFields = $request->validate(([
            'loginname' => ['required'],
            'loginpassword' => ['required'],
        ]));

        if (Auth::attempt([
            'name' => $incomingFields['loginname'],
            'password' => $incomingFields['loginpassword']
        ])) {
            // Authentication passed...
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200'],
        ]);

        // Hash the password
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        // Eloquent ORM to create a new user and save it to the database
        $user = User::create($incomingFields);
        Auth::login($user);

        return redirect('/');
    }
}
