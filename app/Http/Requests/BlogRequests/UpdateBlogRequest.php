<?php

namespace App\Http\Requests\BlogRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'updatedContent' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
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
