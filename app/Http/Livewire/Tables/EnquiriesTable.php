<?php

namespace App\Http\Livewire\Tables;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EnquiriesTable extends DataTableComponent
{
    protected $listeners = ["enquiry-updated" => '$refresh'];

    public bool $openOnly;

    public function mount($openOnly = false) {
        $this->openOnly = $openOnly;
    }

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
            Column::make(__("enquiries.doable"), 'doable_at')
                  ->sortable()
                  ->searchable()
                  ->format(function ($value) {
                      return !empty($value) ? $value->format("Y. m. d. H:i") : "";
                  }),
            Column::make(__("enquiries.mechanic"), 'mechanic.name')
                  ->sortable()
                  ->searchable(),
            Column::make(__("enquiries.answer"), 'answer')
                  ->sortable()
                  ->searchable(),
            Column::make(__("enquiries.closed"), 'closed_at')
                  ->sortable()
                  ->searchable()
                  ->format(function ($value) {
                      return !empty($value) ? $value->format("Y. m. d. H:i") : "";
                  }),
            Column::make(__("enquiries.created_at"), 'created_at')
                  ->sortable()
                  ->searchable()
                  ->format(function ($value) {
                      return !empty($value) ? $value->format("Y. m. d. H:i") : "";
                  }),
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
        if ($this->openOnly) {
            return Enquiry::query()
                          ->whereNotNull("doable_at")
                          ->whereNull("closed_at");
        }

        return Enquiry::query();
    }
}
