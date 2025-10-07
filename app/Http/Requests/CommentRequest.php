<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required',
            'blogId' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'You must write something',
            'blogId.required' => 'Sorry, something went wrong. Please try again later.',
            'blogId.integer' => 'Sorry, something went wrong. Please try again later.',
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
