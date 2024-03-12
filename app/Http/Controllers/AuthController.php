<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('clients.pages.register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'created_at' => date('Y-m-d H:i:s'),
            'role_id' => config('app.role.USER')
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->role == config('app.role.USER')) {
                return redirect('/');
            } else {
                return redirect('/admin');
            }
        }
        return view('clients.pages.login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();
        if (Auth::user()->role_id == config('app.role.USER')) {
            return redirect('/');
        } else {
            return redirect('/admin');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        Auth::guard('web')->logout();


        $request->session()->invalidate();

        return redirect('/');
    }

    public function profile()
    {
        return view('profile');
    }
}
