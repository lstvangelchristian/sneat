<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'You must write something',
            'content.min' => 'Content must be at least 10 characters',
        ];
    }
}
