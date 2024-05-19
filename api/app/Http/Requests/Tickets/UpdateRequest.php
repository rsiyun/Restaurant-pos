<?php

namespace App\Http\Requests\Tickets;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "orderNote" => ['nullable'],
            "ticketCart" => ['required', 'array'],
            "ticketCart.*.slugProduct" => ['required', 'string'],
            "ticketCart.*.quantity" => ['required', 'integer']
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "message" => "Unprocessable Content",
            "status" => false,
            "error" => [
                "code" => 422,
                "description" => $validator->getMessageBag()
            ]
        ], 422));
    }
}
