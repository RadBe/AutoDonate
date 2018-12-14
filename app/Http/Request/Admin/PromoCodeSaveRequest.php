<?php


namespace App\Http\Request\Admin;


use Illuminate\Foundation\Http\FormRequest;

class PromoCodeSaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'string|max:64|nullable',
            'discount' => 'required|integer|min:1|max:99',
            'amount' => 'integer|min:1|nullable',
            'date' => 'string|nullable'
        ];
    }
}