<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\RegisterService;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('components.pages.auth-pages.register');
    }

    public function register(RegisterRequest $request, RegisterService $service)
    {
        try {
            $validated = $request->validated();

            $newAuthor = $service->register($validated);

            Auth::guard('author')->login($newAuthor);

            return response()->json([
                'success' => true,
                'redirect' => route('show-blog'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Sorry, something went wrong. Please try again later.',
            ]);
        }
    }
}
