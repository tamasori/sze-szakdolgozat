<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\EwcCode;
use App\Models\Substance;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MatterExportsTable extends DataTableComponent
{

    public $year;

    public function columns(): array
    {
        return [
            Column::make(__("substances.in_material_balance_short"))
                ->format(function ($value, $column, $row) {
                    return UIHelper::getBooleanDisplay($row->in_material_balance);
                })
                ->asHtml(),
            Column::make(__("substances.date"), 'date')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.ewc_code"), 'ewcCode.code')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.mass"), 'mass')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.pretreatment_mass"), 'pretreatment_mass')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.collector_mass"), 'collector_mass')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.disposal_mass"), 'disposal_mass')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.export_mass"), 'export_mass')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.company_name"), 'company_name')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.kuj_number"), 'kuj_number')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.ktj_number"), 'ktj_number')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.treatment_code"), 'treatment_code')
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.delivery_note"), 'delivery_note')
                  ->sortable()
                  ->searchable(),
            Column::make('')
                  ->format(function ($row) {
                      return view('matterExports.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Substance::query()
            ->whereYear("date", $this->year)
            ->where("from_export", true)
            ->orderBy("date")
            ->orderBy("created_at");
    }
}
