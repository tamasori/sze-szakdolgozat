<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CustomersTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__("customers.company"), 'company')
                  ->sortable()
                  ->searchable(),
            Column::make(__("customers.company_registration_number"), 'company_registration_number')
                  ->sortable()
                  ->searchable(),
            Column::make(__("customers.name"), 'name')
                  ->sortable()
                  ->searchable(),
            Column::make(__("customers.email"), 'email')
                  ->sortable()
                  ->searchable(),
            Column::make(__("customers.phone_number"), 'phone_number')
                  ->sortable()
                  ->searchable(),
            Column::make('')
                  ->format(function (Customer $row) {
                      return view('customers.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Customer::query();
    }
}
