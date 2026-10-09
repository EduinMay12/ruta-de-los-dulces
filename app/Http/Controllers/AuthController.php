<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {

            return redirect()
                ->route('admin.index');
        }

        return view('auth.login');
    }


    public function authenticate(
        Request $request
    )
    {
        $credentials =
            $request->validate([

                'email' =>
                    'required|email',

                'password' =>
                    'required|string',

            ]);


        if (Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {

            $request->session()
                ->regenerate();


            return redirect()
                ->intended(
                    route('admin.index')
                );
        }


        return back()
            ->withErrors([

                'email' =>
                    'Correo o contraseña incorrectos.'

            ])
            ->onlyInput('email');
    }


    public function logout(
        Request $request
    )
    {
        Auth::logout();


        $request->session()
            ->invalidate();


        $request->session()
            ->regenerateToken();


        return redirect()
            ->route('home');
    }
}