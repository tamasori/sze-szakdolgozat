<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabberworm\CSS\Rule\Rule;

class InspectorsStoreRequest extends FormRequest
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
            'company'                     => 'nullable',
            'company_registration_number' => 'nullable',
            'name'                        => 'required',
            'email'                       => 'nullable|email|max:254',
            'phone_number'                => 'required',
            'city'                        => 'required',
            'street'                      => 'required',
            'house_number'                => 'required',
            'vat_number'                  => 'nullable',
            'public_identifier_numbers'   => 'required',
            'note'                        => 'nullable',
        ];
    }
}
