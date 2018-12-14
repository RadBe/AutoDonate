<?php


namespace App\Http\Request\Admin;


use Illuminate\Foundation\Http\FormRequest;

class ProductTypeSaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string',
            'name' => 'required|string',
            'surcharge' => 'boolean',
            'distributor' => 'required|string',
            'data' => 'string|nullable'
        ];
    }
}