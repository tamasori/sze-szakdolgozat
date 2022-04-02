<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\EwcCode;
use App\Models\Preset;
use App\Models\WorkshopMachinery;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MachinesTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__("machines.local_identifier"), 'local_identifier')
                  ->sortable()
                  ->searchable(),
            Column::make(__("machines.name"), 'name')
                  ->sortable()
                  ->searchable(),
            Column::make('')
                  ->format(function ($row) {
                      return view('machineries.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return WorkshopMachinery::query();
    }
}
