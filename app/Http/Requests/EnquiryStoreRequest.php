<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryStoreRequest extends FormRequest {
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
            "part_id"     => "required|int|exists:parts,id",
            "customer_id" => "required|int|exists:customers,id",
            "car_make"    => "required|string|max:255",
            "car_model"   => "required|string|max:255",
            "car_year"    => "required|numeric|max:2155|min:1901",
            "note"        => "nullable|string",
        ];
    }
}
