<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\EwcCode;
use App\Models\Preset;
use App\Models\Inspector;
use App\Models\WorkshopMachinery;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class InspectorsTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__("inspectors.company"), 'company')
                  ->sortable()
                  ->searchable(),
            Column::make(__("inspectors.name"), 'name')
                  ->sortable()
                  ->searchable(),
            Column::make(__("inspectors.email"), 'email')
                  ->sortable()
                  ->searchable(),
            Column::make(__("inspectors.phone_number"), 'phone_number')
                  ->sortable()
                  ->searchable(),
            Column::make(__("inspectors.city"), 'city')
                  ->sortable()
                  ->searchable(),
            Column::make(__("inspectors.public_identifier_numbers"), 'public_identifier_numbers')
                  ->sortable()
                  ->searchable(),
            Column::make('')
                  ->format(function ($row) {
                      return view('inspectors.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Inspector::query();
    }
}
