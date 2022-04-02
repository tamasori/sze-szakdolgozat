<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\EwcCode;
use App\Models\Preset;
use App\Models\Inspector;
use App\Models\LogbookEntry;
use App\Models\WorkshopMachinery;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LogbookEntriesTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__("logbook-entries.date"), 'date')
                  ->sortable()
                  ->searchable(),
            Column::make(__("logbook-entries.log_type"))
                  ->format(function ($s, $f, LogbookEntry $row) {
                      return __("logbook-entries.log_types.{$row->log_type}");
                  }),
            Column::make(__("logbook-entries.check_type"))
                  ->format(function ($s, $f, LogbookEntry $row) {
                      return __("logbook-entries.check_types.{$row->check_type}");
                  }),
            Column::make(__("logbook-entries.description"), 'description')
                  ->sortable()
                  ->searchable(),
            Column::make(__("logbook-entries.result"), 'result')
                  ->sortable()
                  ->searchable(),
            Column::make('')
                  ->format(function ($row) {
                      return view('logbook-entries.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return LogbookEntry::query()
            ->orderBy("date", "desc");
    }
}
