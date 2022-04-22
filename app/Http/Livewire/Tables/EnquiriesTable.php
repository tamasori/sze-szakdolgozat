<?php

namespace App\Http\Livewire\Tables;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EnquiriesTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__("enquiries.part"), 'part.name')
                  ->sortable()
                  ->searchable(),
            Column::make(__("enquiries.car_make"), 'carModel.carMake.make')
                  ->sortable()
                  ->searchable(),
            Column::make(__("enquiries.car_model"), 'carModel.model')
                  ->sortable()
                  ->searchable(),
            Column::make(__("enquiries.car_year"), 'car_year')
                  ->sortable()
                  ->searchable(),
            Column::make(__("enquiries.customer"), 'customer.name')
                  ->sortable()
                  ->searchable(),
            Column::make('')
                  ->format(function (Enquiry $row) {
                      return view('enquiries.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Enquiry::query();
    }
}
