<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\EwcCode;
use App\Models\Preset;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PresetsTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__("presets.name"), 'name')
                  ->sortable()
                  ->searchable(),
            Column::make(__("presets.substances"))
                  ->format(function ($value, $column, $row) {
                      return UIHelper::getPresetSubstanceList($row);
                  })
                  ->asHtml(),
            Column::make('')
                  ->format(function ($row) {
                      return view('presets.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Preset::query();
    }
}
