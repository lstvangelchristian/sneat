<?php

namespace App\Http\Requests\ReplyRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateReplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'commentId' => 'required|integer',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'commentId.required' => 'Sorry, something went wrong. Please try again later.',
            'commentId.integer' => 'Sorry, something went wrong. Please try again later.',
            'content.required' => 'You must write something',
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
