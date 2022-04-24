<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\EwcCode;
use App\Models\Preset;
use App\Models\Inspector;
use App\Models\LogbookEntry;
use App\Models\PredefinedAnswer;
use App\Models\WorkshopMachinery;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PredefinedAnswersTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__("predefined-answers.answer"), 'answer')
                  ->sortable()
                  ->searchable(),
            Column::make('')
                  ->format(function ($row) {
                      return view('predefined-answers.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return PredefinedAnswer::query()
            ->orderBy("answer");
    }
}
