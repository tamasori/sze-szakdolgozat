<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
            "car" => "array|required",
            "car.local_identifier" => "required|numeric|min:0|unique:cars,local_identifier" . ($this->route('car') !== null ? "," . $this->route('car') : ""),
            "car.demolition_certificate_number" => "required|string|max:255|unique:cars,demolition_certificate_number",
            "car.date_of_demolition" => "required|date",
            "car.zip" => "required|max:4",
            "car.city" => "required|string|max:255",
            "car.company_name" => "nullable|string|max:255",
            "car.kuj_number" => "nullable|string|max:255",
            "car.ktj_number" => "nullable|string|max:255",
            "car_make" => "required|string|max:255",
            "car_model" => "required|string|max:255",
            "car.year" => "required|max:4",
            "car.fuel_type_id" => "required|numeric|exists:fuel_types,id",
            "car.vin" => "required|string|max:255",
            "car.engine_code" => "required|string|max:255",
            "car.engine_ccm" => "required|numeric|max:255",
            "car.power" => "required|numeric|max:255",
            "color" => "required|string|max:255",
            "car.own_weight" => "required|numeric|max:255",
            "car.retrieved_weight" => "required|numeric|max:255",
            "car.dry_weight" => "required|numeric|max:255",
            "car.note" => "nullable|string|max:255",
            "substances.*.date" => "required|date",
            "substances.*.ewc_code_id" => "required|numeric|exists:ewc_codes,id",
            "substances.*.part_name" => "nullable|numeric|max:255",
            "substances.*.mass" => "required|numeric|max:255",
        ];
    }

    public function attributes()
    {
        return [
            "car.local_identifier" => __("cars.local_identifier"),
            "car.demolition_certificate_number" => __("cars.demolition_certificate_number"),
            "car.date_of_demolition" => __("cars.date_of_demolition"),
            "car.zip" => __("cars.zip"),
            "car.city" => __("cars.city"),
            "car.company_name" => __("cars.company_name"),
            "car.kuj_number" => __("cars.kuj_number"),
            "car.ktj_number" => __("cars.ktj_number"),
            "car_make" => __("cars.car_make"),
            "car_model" => __("cars.car_model"),
            "car.year" => __("cars.year"),
            "car.fuel_type_id" => __("cars.fuel_type_id"),
            "car.vin" => __("cars.vin"),
            "car.engine_code" => __("cars.engine_code"),
            "car.engine_ccm" => __("cars.engine_ccm"),
            "car.power" => __("cars.power"),
            "color" => __("cars.color"),
            "car.own_weight" => __("cars.own_weight"),
            "car.retrieved_weight" => __("cars.retrieved_weight"),
            "car.dry_weight" => __("cars.dry_weight"),
            "car.note" => __("cars.note"),
            "substances.*.date" => __("substances.date"),
            "substances.*.ewc_code_id" => __("substances.ewc_code_id"),
            "substances.*.part_name" => __("substances.part_name"),
            "substances.*.mass" => __("substances.mass"),
        ];
    }
}
