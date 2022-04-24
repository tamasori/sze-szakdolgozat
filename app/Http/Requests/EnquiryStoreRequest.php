<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryStoreRequest extends FormRequest
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
            "part"        => "required|string|max:255",
            "customer_id" => "required|int|exists:customers,id",
            "car_make"    => "required|string|max:255",
            "car_model"   => "required|string|max:255",
            "car_year"    => "required|numeric|max:2155|min:1901",
            "note"        => "nullable|string",
        ];
    }

    public function attributes()
    {
        return [
            "part" => __("enquiries.part"),
            "customer_id" => __("enquiries.customer_id"),
            "car_make" => __("enquiries.car_make"),
            "car_model" => __("enquiries.car_model"),
            "car_year" => __("enquiries.car_year"),
            "note" => __("enquiries.note"),
        ];
    }
}
