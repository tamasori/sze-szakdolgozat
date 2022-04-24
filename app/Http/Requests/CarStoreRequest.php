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
            "car.local_identifier" => "required|numeric|min:0|unique:cars,local_identifier",
            "car.demolition_certificate_number" => "required|string|max:255|unique:cars,demolition_certificate_number",
            "car.date_of_demolition" => "required|date",
            "car.zip" => "required|numeric|max:4",
            "car.city" => "required|string|max:255",
            "car.company_name" => "nullable|string|max:255",
            "car.kuj_number" => "nullable|string|max:255",
            "car.ktj_number" => "nullable|string|max:255",
            "car_make" => "required|string|max:255",
            "car_model" => "required|string|max:255",
            "car.year" => "required|numeric|max:4",
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
}
