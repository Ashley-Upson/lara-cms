<?php

namespace AshleyUpson\LaraCMS\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function viewLogin()
    {
//        if(Auth::check()) {
//            return redirect()->back();
//        }

        return view('laracms::themes.default.auth.login');
    }

    public function viewRegister()
    {
        if(Auth::check()) {
            return redirect()->back();
        }

        return view('laracms::themes.default.auth.register');
    }

    public function login(Request $request)
    {
        $creds = $request->only('email', 'password');
        $remember = $request->get('remember');

        if($creds['email'] == null || $creds['password'] == null) {
            return redirect()->route('laracms::get.auth/login')->with([
                'error' => 'Credentials invalid.',
                'email' => $creds['email'],
                'remember' => $remember
            ]);
        }

        if(Auth::attempt($creds, $request->get('remember')) === true) {
            return redirect()->to($request->get('next') ?? '/');
        } else {
            return redirect()->route('laracms::get.auth/login')->with([
                'error' => 'Credentials invalid.',
                'email' => $creds['email'],
                'remember' => $remember
            ]);
        }
    }

    public function register(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $pass1 = $request->get('password');
        $pass2 = $request->get('password_confirm');

        $error = null;

        if($name == null) {
            $error = 'Name is required';
        }

        $atPos = strpos($email, '@');
        $dotPos = strpos($email, '.', $atPos);

        if($atPos === false || $dotPos === false) {
            $error = 'Email is not valid.';
        }

        if(strlen($pass1) < 8) {
            $error = 'Minimum password length is 8 characters.';
        }

        if($pass1 !== $pass2) {
            $error = 'Passwords do not match.';
        }

        if($error != null) {
            return redirect()->route('laracms::get.auth/register')->with([
                'error' => $error,
                'name' => $name,
                'email' => $email
            ]);
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($pass1)
        ]);

        return redirect()->route('laracms::get.auth/login')->with([
            'message' => 'Account created successfully, you may now login.'
        ]);
    }
}
