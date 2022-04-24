<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\EwcCode;
use App\Models\Preset;
use App\Models\Substance;
use App\Exports\SalesExport;
use App\Exports\AllCarDataExport;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SalesTable extends DataTableComponent
{
    public array $bulkActions = [
        'exportAll'               => "Összes adat exportálása",
    ];

    public function exportAll()
    {
        return (new SalesExport($this->getFilter("date_from"),$this->getFilter("date_to")))->download('ertekesites_'.\Str::slug(now()).'.xlsx');
    }

    public function filters(): array
    {
        return [
            'date_from' => Filter::make(__("substances.date")." ".__("misc.from"))
                                               ->date(),
            'date_to'   => Filter::make(__("substances.date")." ".__("misc.to"))
                                               ->date(),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make(__("substances.date"), 'date')
                  ->sortable()
                  ->searchable(),
            Column::make(__("sales.type"))
                  ->format(function ($value, $column, $row) {
                      return __("sales.receipt");
                  }),
            Column::make(__("substances.mass"),"mass")
                ->sortable()
                ->searchable(),
            Column::make(__("sales.quantity"),)
                ->format(function ($value, $column, $row) {
                    return "1";
                }),
            Column::make(__("cars.demolition_certificate_number"),"car.demolition_certificate_number")
                  ->sortable()
                  ->searchable(),
            Column::make(__("cars.year"),"car.year")
                  ->sortable()
                  ->searchable(),
            Column::make(__("cars.car_make"),"car.carModel.carMake.make")
                  ->sortable()
                  ->searchable(),
            Column::make(__("substances.part_name"),"part_name")
                  ->sortable()
                  ->searchable(),
            Column::make(__("sales.quality_color"),)
                  ->format(function ($value, $column, $row) {
                      return __("sales.quality_color_red");
                  }),
        ];
    }

    public function query(): Builder
    {
        return Substance::with(["car", "ewcCode"])
            ->whereRelation("ewcCode","code", "=", "R4")
            ->whereHas("car")
            ->orderBy("date")
            ->when($this->getFilter("date_from"), fn($query, $dateFrom) => $query->where("date",">=", $dateFrom))
            ->when($this->getFilter("date_to"), fn($query, $dateTo) => $query->where("date","<=", $dateTo));
    }
}
