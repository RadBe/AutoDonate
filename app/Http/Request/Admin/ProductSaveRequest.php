<?php


namespace App\Http\Request\Admin;


use Illuminate\Foundation\Http\FormRequest;

class ProductSaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category' => 'required|integer',
            'price' => 'required|integer|min:1',
            'name' => 'required|string'
        ];
    }
}