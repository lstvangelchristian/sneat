<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('components.pages.auth-pages.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $validated = $request->validated();

            if (Auth::guard('author')->attempt($validated)) {
                $request->session()->regenerate();

                return response()->json([
                    'success' => true,
                    'redirect' => route('show-register'),
                ]);
            }

            return response()->json([
                'success' => false,
                'error' => 'Invalid Credentials',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Sorry, something went wrong. Please try again later.',
            ]);
        }
    }
}
