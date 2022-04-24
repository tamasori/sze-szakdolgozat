<?php

namespace App\Http\Requests;

use App\Models\LogbookEntry;
use Illuminate\Foundation\Http\FormRequest;
use Sabberworm\CSS\Rule\Rule;

class LogbookEntriesStoreRequest extends FormRequest
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
            'log_type'    => ['required','in:'.implode(',', LogbookEntry::LOG_TYPES)],
            'check_type'  => ['required','in:'.implode(',', LogbookEntry::CHECK_TYPES)],
            'date'        => ['required','date'],
            'description' => ['required'],
            'result'      => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'log_type' => __("logbook-entries.log_type"),
            'check_type' => __("logbook-entries.check_type"),
            'date' => __("logbook-entries.date"),
            'description' => __("logbook-entries.description"),
            'result' => __("logbook-entries.result"),
        ];
    }
}
