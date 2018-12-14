<?php


namespace App\Http\Request\Admin;


use Illuminate\Foundation\Http\FormRequest;

class ServerSaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'enabled' => 'boolean',
            'r_ip' => 'required|string|ip',
            'r_port' => 'required|integer|min:1',
            'r_pass' => 'required|string|max:255',
        ];
    }
}