<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabberworm\CSS\Rule\Rule;

class MachinesStoreRequest extends FormRequest
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
            "local_identifier" => [
                "required", "string", "max:255",
                ($this->machine ? \Illuminate\Validation\Rule::unique("workshop_machineries",
                    "local_identifier")->ignore($this->machine->id) : "unique:workshop_machineries,local_identifier"),
            ],
            "name"             => ["required", "string", "max:255"],
        ];
    }

    public function attributes()
    {
        return [
            "local_indentifier" => __('machines.local_identifier'),
            "name"              => __('machines.name'),
        ];
    }
}
