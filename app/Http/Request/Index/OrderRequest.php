<?php


namespace App\Http\Request\Index;


use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'method' => 'required|string',
            'product' => 'required|integer',
            'promo' => 'string|nullable'
        ];
    }
}