<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'idShop' => ['required', 'integer'],
            'productImage' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:10240'],
            'productName' => ['required', 'string'],
            'productPrice' => ['required', 'numeric'],
            'productType' => ['required', new Enum(ProductType::class)],
            'productStock' => ['required', 'integer'],
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
