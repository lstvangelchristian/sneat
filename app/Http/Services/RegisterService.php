<?php

namespace App\Http\Services;

use App\Models\Author;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function register(array $author)
    {
        return Author::create([
            'username' => $author['username'],
            'password' => Hash::make($author['password']),
        ]);
    }
}
