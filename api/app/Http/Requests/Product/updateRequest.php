<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class updateRequest extends FormRequest
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
            'idShop' => ['nullable', 'integer'],
            'productImage' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:10240'],
            'productName' => ['nullable', 'string'],
            'productPrice' => ['nullable', 'numeric'],
            'productType' => ['nullable', new Enum(ProductType::class)],
            'productStock' => ['nullable', 'integer'],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "message" => "Unprocessable Content",
            "status" => false,
            "error" => [
                "code" => 404,
                "description" => $validator->getMessageBag()
            ]
        ],422));
    }
}
