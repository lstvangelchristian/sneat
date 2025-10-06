<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('pages.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $validated = $request->validated();

            if (Auth::guard('author')->attempt($validated)) {
                $request->session()->regenerate();

                return response()->json([
                    'success' => true,
                    'redirect' => route('show-blog'),
                ]);
            }

            return response()->json([
                'success' => false,
                'errors' => [
                    'credential' => ['You entered an incorrect credential, please try again.'],
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Pleas try again later.'],
                ],
            ]);
        }
    }
}
