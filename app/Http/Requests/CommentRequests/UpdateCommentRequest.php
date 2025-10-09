<?php

namespace App\Http\Requests\CommentRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'commentId' => 'required|integer',
            'updatedComment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'commentId.required' => 'Sorry, something went wrong. Please try again later.',
            'commentId.integer' => 'Sorry, something went wrong. Please try again later.',
            'updatedComment.required' => 'You must write somethig.',
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
