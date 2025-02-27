<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            return [
                'name' => 'required|string|max:258',
                'email' => 'required|email|string',
                'password' => 'required|string'
            ];
        }else{
            return [
                'name' => 'required|string|max:258',
                'email' => 'required|email|string',
            ];
        }
    }
    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                "name.required" => "Name is required",
                "email.required" => "Email is required",
                "password.required" => "Password is required",
            ];
        }else{
            return [
                "name.required" => "Name is required",
                "email.required" => "Email is required",
            ];
        }
    }
}
