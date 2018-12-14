<?php


namespace App\Http\Request\Admin;


use Illuminate\Foundation\Http\FormRequest;

class CategorySaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'server' => 'required|integer',
            'type' => 'required|string',
            'name' => 'required|string',
            'weight' => 'required|integer',
        ];
    }
}