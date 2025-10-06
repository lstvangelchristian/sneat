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
        return view('pages.register');
    }

    public function register(RegisterRequest $request, RegisterService $service)
    {
        try {
            $validated = $request->validated();

            $newAuthor = $service->register($validated);

            Auth::guard('author')->login($newAuthor);

            return response()->json(['redirect' => route('show-blog')]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Pleas try again later.'],
                ],
            ]);
        }
    }
}
