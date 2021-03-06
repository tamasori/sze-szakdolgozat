<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PredefinedAnswerStoreRequest extends FormRequest
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
            "answer" => ["required", "string", "max:255", "unique:predefined_answers,answer"],
        ];
    }

    public function attributes()
    {
        return [
            "answer" => __("predefined-answers.answer"),
        ];
    }
}
