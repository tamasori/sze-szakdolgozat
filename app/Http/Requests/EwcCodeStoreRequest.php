<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EwcCodeStoreRequest extends FormRequest
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
            "code" => ["required","unique:ewc_codes,code" . (isset($this->ewc_code) ? "," . $this->ewc_code->id : "")],
            "name" => ["required"],
            "short_name" => ["required"],
            "physical_form" => ["nullable"],
            "packaging_method" => ["nullable"],
            "expected_delivery_frequency" => ["required"],
            "h_property" => ["nullable"],
            "hazardous" => ["sometimes","boolean"],
            "chemical_name_of_parts" => ["nullable"],
            "type_of_hazard" => ["required_if:hazardous,1"],
            "hazardous_reactions" => ["nullable"],
            "c_components" => ["nullable"],
            "r_sentences" => ["required_if:hazardous,0"],
            "origin" => ["required"],
            "technology_identifier_number" => ["required"],
            "teaor_codes" => ["required"]
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            "code" => __("ewc-codes.code"),
            "name" => __("ewc-codes.name"),
            "short_name" => __("ewc-codes.short_name"),
            "physical_form" => __("ewc-codes.physical_form"),
            "packaging_method" => __("ewc-codes.packaging_method"),
            "expected_delivery_frequency" => __("ewc-codes.expected_delivery_frequency"),
            "h_property" => __("ewc-codes.h_property"),
            "hazardous" => __("ewc-codes.hazardous"),
            "chemical_name_of_parts" => __("ewc-codes.chemical_name_of_parts"),
            "type_of_hazard" => __("ewc-codes.type_of_hazard"),
            "hazardous_reactions" => __("ewc-codes.hazardous_reactions"),
            "origin" => __("ewc-codes.origin"),
            "technology_identifier_number" => __("ewc-codes.technology_identifier_number"),
            "teaor_codes" => __("ewc-codes.teaor_codes"),
            "r_sentences" => __("ewc-codes.r_sentences"),
            "c_components" => __("ewc-codes.c_components"),
        ];
    }
}
