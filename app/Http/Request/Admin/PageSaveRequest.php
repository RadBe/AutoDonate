<?php


namespace App\Http\Request\Admin;


use Illuminate\Foundation\Http\FormRequest;

class PageSaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => 'required|string',
            'title' => 'required|string',
            'content' => 'required|string'
        ];
    }
}