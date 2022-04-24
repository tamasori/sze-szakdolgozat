<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabberworm\CSS\Rule\Rule;

class InspectonRecordsStoreRequest extends FormRequest
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
            'date'                  => ['required','date'],
            'workshop_machinery_id' => ['required','integer','exists:workshop_machineries,id'],
            'inspector_id'          => ['required','integer','exists:inspectors,id'],
            'valid_till'            => ['nullable','date'],
            'result'                => ['required'],
            'note'                  => ['nullable'],
            'created_by'            => ['nullable','integer'],
        ];
    }

    public function attributes()
    {
        return [
            "date" => __("inspection-records.date"),
            "workshop_machinery_id" => __("inspection-records.workshop_machinery_id"),
            "inspector_id" => __("inspection-records.inspector_id"),
            "valid_till" => __("inspection-records.valid_till"),
            "result" => __("inspection-records.result"),
            "note" => __("inspection-records.note"),
            "created_by" => __("inspection-records.created_by"),
        ];
    }
}
