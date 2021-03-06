<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "email" => ["required","email"],
            "password" => ["required"],
            "remember" => ["sometimes","boolean"]
        ];
    }

    public function attributes()
    {
        return [
            "email" => __('users.email'),
            "password" => __('users.password'),
            "remember" => __('auth.remember_me')
        ];
    }
}
