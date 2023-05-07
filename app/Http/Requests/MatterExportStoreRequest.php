<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatterExportStoreRequest extends FormRequest
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
            "in_material_balance" => ["boolean"],
            "date" => ["required", "date"],
            "ewc_code_id" => ["required", "exists:ewc_codes,id"],
            "mass" => ["nullable", "numeric"],
            "export_mass" => ["nullable", "numeric"],
            "pretreatment_mass" => ["nullable", "numeric"],
            "collector_mass" => ["nullable", "numeric"],
            "disposal_mass" => ["nullable", "numeric"],
            "company_name" => ["nullable", "string"],
            "kuj_number" => ["nullable", "string"],
            "ktj_number" => ["nullable", "string"],
            "treatment_code" => ["nullable", "string"],
            "delivery_note" => ["nullable", "string"],
        ];
    }

    public function attributes()
    {
        return [
            "in_material_balance" => __("substances.in_material_balance"),
            "date" => __("substances.date"),
            "ewc_code_id" => __("substances.ewc_code"),
            "mass" => __("substances.mass"),
            "export_mass" => __("substances.export_mass"),
            "pretreatment_mass" => __("substances.pretreatment_mass"),
            "disposal_mass" => __("substances.disposal_mass"),
            "company_name" => __("substances.company_name"),
            "kuj_number" => __("substances.kuj_number"),
            "ktj_number" => __("substances.ktj_number"),
            "treatment_code" => __("substances.treatment_code"),
            "delivery_note" => __("substances.delivery_note"),
        ];
    }
}
