<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'content' => 'required|min:10',
            ];
        }

        if ($this->isMethod('put')) {
            return [
                'updatedContent' => 'required|min:10',
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'content.required' => 'You must write something',
            'content.min' => 'Content must be at least 10 characters',
            'updatedContent.required' => 'You must write something',
            'updatedContent.min' => 'Content must be at least 10 characters',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
