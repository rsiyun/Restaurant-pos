<?php

namespace App\Http\Requests\User;

use App\Enums\Role;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

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
            'name' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'password' => ['nullable', 'string'],
            'idShop' => ['nullable', 'integer'],
            'role' => ['nullable', new Enum(Role::class)],
            'isActive' => ['nullable', 'boolean'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "message" => "Unprocessable Content",
            "success" => false,
            "error" => [
                "code" => 422,
                "description" => $validator->getMessageBag()
            ]
        ], 422));
    }
}
