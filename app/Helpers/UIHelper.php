<?php


namespace App\Helpers;


use App\Models\Preset;

class UIHelper
{
    public static function getBooleanDisplay(bool $value)
    {
        if ($value) {
            return '<span class="badge bg-success">Igen</span>';
        } else {
            return '<span class="badge bg-danger">Nem</span>';
        }
    }

    public static function getPresetSubstanceList(Preset $preset)
    {
        $returnString = "<table class='table'>
                                <thead>
                                    <th>".__("substances.ewc_code")."</th>
                                    <th>".__("substances.part_name")."</th>
                                    <th>".__("substances.mass")."</th>
                                </thead>
                            <tbody>";
        foreach ($preset->convertFieldsToArray() as $field) {
            $returnString .= "<tr>
                                <td>".$field['ewc_code']->code."</td>
                                <td>".$field['part_name']."</td>
                                <td>".$field['mass']."</td>
                            </tr>";
        }
        $returnString .= "</tbody>
                        </table>";

        return $returnString;
    }
}
