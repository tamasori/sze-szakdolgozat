<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preset extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function convertFieldsToArray()
    {
        $fields = json_decode($this->fields, true);
        $return = [];

        foreach ($fields as $key => $field) {
            $return[] = [
                "ewc_code" => EwcCode::find($field['ewc_code_id']),
                "ewc_code_id" => $field['ewc_code_id'],
                "part_name" => $field["part_name"],
                "mass" => floatval($field["mass"]),
                "id" => $key
            ];
        }

        return $return;
    }
}
