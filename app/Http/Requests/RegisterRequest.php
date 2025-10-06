<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|unique:authors,username',
            'password' => 'required|min:10|same:confirmPassword',
            'confirmPassword' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username field is required',
            'username.unique' => 'Username is already taken',
            'password.required' => 'Password field is required',
            'password.min' => 'Password must be at least 10 characters',
            'password.same' => 'Password does not match',
            'confirmPassword.required' => 'Confirm password field is required',
        ];
    }
}
