<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabberworm\CSS\Rule\Rule;

class PresetStoreRequest extends FormRequest
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
            "name" => ["required",($this->preset ? \Illuminate\Validation\Rule::unique("presets","name")->ignore($this->preset->id) : "unique:presets,name")],
            "substances.*.ewc_code_id" => "required|numeric|exists:ewc_codes,id",
            "substances.*.part_name" => "nullable|string|max:255",
            "substances.*.mass" => "required|numeric|max:255",
        ];
    }

    public function attributes()
    {
        return [
            "name" => __("presets.name"),
            "substances.*.ewc_code_id" => __("substances.ewc_code"),
            "substances.*.part_name" => __("substances.part_name"),
            "substances.*.mass" => __("substances.mass"),
        ];
    }
}
