<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "company"                     => "nullable|string|max:255",
            "company_registration_number" => "nullable|string|max:255",
            "name"                        => "required|string|max:255",
            "email"                       => "nullable|email|max:255",
            "phone_number"                => "nullable|string|max:255",
            "city"                        => "nullable|string|max:255",
            "street"                      => "nullable|string|max:255",
            "house_number"                => "nullable|string|max:255",
            "vat_number"                  => "nullable|string|max:255",
            "note"                        => "nullable|string",
        ];
    }
}
