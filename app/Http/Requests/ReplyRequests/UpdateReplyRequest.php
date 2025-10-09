<?php

namespace App\Http\Requests\ReplyRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateReplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'replyId' => 'required|integer',
            'updatedReply' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'replyId.required' => 'Sorry, something went wrong. Please try again later.',
            'replyId.integer' => 'Sorry, something went wrong. Please try again later.',
            'updatedReply.required' => 'You must write something',
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
