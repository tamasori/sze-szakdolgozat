<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\EwcCode;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EwcCodesTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__("ewc-codes.code"), 'code')
                  ->sortable()
                  ->searchable(),
            Column::make(__("ewc-codes.short_name"), 'short_name')
                  ->sortable()
                  ->searchable(),
            Column::make(__("ewc-codes.hazardous"))
                  ->format(function ($value, $column, $row) {
                      return UIHelper::getBooleanDisplay($row->hazardous);
                  })
                  ->asHtml(),
            Column::make('')
                  ->format(function ($row) {
                      return view('ewcCodes.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return EwcCode::query();
    }
}
