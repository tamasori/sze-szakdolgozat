<?php

namespace App\Http\Livewire\Tables;

use App\Helpers\UIHelper;
use App\Models\EwcCode;
use App\Models\Preset;
use App\Models\Inspector;
use App\Models\InspectionRecord;
use App\Models\WorkshopMachinery;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class InspectionRecordsTable extends DataTableComponent
{
    public $machineId = null;

    public function columns(): array
    {
        return [
            Column::make(__("inspection-records.date"), 'date')
                  ->sortable()
                  ->searchable(),
            Column::make(__("inspection-records.workshop_machinery_id"))
                  ->format(function ($s, $f, InspectionRecord $row) {
                      return $row->workshopMachinery->name;
                  })
                  ->searchable(function (Builder $query, $searchTerm) {
                      $query->orWhereHas("workshopMachinery", function ($query) use ($searchTerm) {
                          return $query->where("name", "LIKE", "%$searchTerm%");
                      });
                  }),
            Column::make(__("inspection-records.inspector_id"))
                  ->format(function ($s, $f, InspectionRecord $row) {
                      return "{$row->inspector->name} ({$row->inspector->company})";
                  })
                  ->searchable(function (Builder $query, $searchTerm) {
                      $query->orWhereHas("inspector", function ($query) use ($searchTerm) {
                          return $query->where("name", "LIKE", "%$searchTerm%")
                                       ->orWhere("company", "LIKE", "%$searchTerm%");
                      });
                  }),
            Column::make(__("inspection-records.valid_till"), 'valid_till')
                  ->sortable()
                  ->searchable(),
            Column::make(__("inspection-records.result"), 'result')
                  ->sortable()
                  ->searchable(),
            Column::make('')
                  ->format(function ($row) {
                      return view('inspection-records.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return InspectionRecord::with(["workshopMachinery", "inspector"])
                               ->orderBy("date", "DESC")
                               ->when(! empty($this->machineId), function ($query) {
                                   return $query->where("workshop_machinery_id", $this->machineId);
                               });
    }
}
