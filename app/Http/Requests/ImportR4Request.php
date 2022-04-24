<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportR4Request extends FormRequest
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
            'file' => 'required|mimes:xls,xlsx,csv',
        ];
    }

    public function attributes()
    {
        return [
            "file" => __("imports.file")
        ];
    }
}
