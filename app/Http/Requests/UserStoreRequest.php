<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255", "unique:users,email". (!empty($this->user) ? ",".$this->user->id : "")],
            "password" => ["nullable", "string", "min:8"],
            "role" => ["required", "in:ADMIN,DISPATCHER,MECHANIC"],
        ];
    }

    public function attributes()
    {
        return [
            "name" => __("users.name"),
            "email" => __("users.email"),
            "password" => __("users.password"),
            "role" => __("users.role"),
        ];
    }
}
