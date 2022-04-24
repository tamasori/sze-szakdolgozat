<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use App\Helpers\UIHelper;
use App\Models\EwcCode;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__("users.name"), 'name')
                  ->sortable()
                  ->searchable(),
            Column::make(__("users.email"), 'email')
                  ->sortable()
                  ->searchable(),
            Column::make(__("users.role"), 'role')
                  ->format(function ($s, $v,User $row){
                      switch ($row->role){
                          case User::ADMIN:
                              return __("users.roles.admin");
                          case User::DISPATCHER:
                              return __("users.roles.dispatcher");
                          case User::MECHANIC:
                              return __("users.roles.mechanic");
                          default:
                              return "N/A";
                      }
                  }),
            Column::make('')
                  ->format(function ($row) {
                      return view('users.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return User::query();
    }
}
