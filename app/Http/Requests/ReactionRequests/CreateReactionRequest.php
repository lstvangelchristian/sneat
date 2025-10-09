<?php

namespace App\Http\Requests\ReactionRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateReactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blog_id' => 'required|integer',
            'type_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        $message = 'Sorry, something went wrong. Please try again later.';

        return [
            'blog_id.required' => $message,
            'blog_id.integer' => $message,
            'type_id.required' => $message,
            'type_id.integer' => $message,
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
