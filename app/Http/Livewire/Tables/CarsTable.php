<?php

namespace App\Http\Livewire\Tables;

use App\Exports\AllCarDataExport;
use App\Exports\DestructionNumberExport;
use App\Exports\CarStatisticsByCityExport;
use App\Exports\CarStatisticsByMakeExport;
use App\Helpers\UIHelper;
use App\Models\Car;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\EwcCode;
use App\Models\FuelType;
use Illuminate\Database\Eloquent\Builder;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;
use phpDocumentor\Reflection\Types\Collection;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class CarsTable extends DataTableComponent
{
    public string $defaultSortColumn = 'local_identifier';
    public string $defaultSortDirection = 'desc';
    public string $engineCodeSearch = "";

    protected $listeners = ["loadedStatisticsPanel" => "sendStatistics", "engineCodeSearch" => "setEngineCode"];
    public array $bulkActions = [
        'exportAll'               => "Összes adat exportálása",
        'exportCompanyCars'       => "Céges autók exportálása",
        'before1989Export'        => "1989 előttiek exportálása",
        'byCityStatsExport'       => "Városonkénti statisztika exportálása",
        'byMakeStatsExport'       => "Márkánként statisztika exportálása",
        'carLabelsExport'         => "Cimke generálás",
        'destructionNumberExport' => "Bont.Ig. számok exportálása",
        'resaveAllCars' => "Autók elmentése újra",
    ];

    public function setEngineCode($code){
        $this->engineCodeSearch = $code;
    }

    public function resaveAllCars()
    {
        $cars = $this->getFilteredQuery()->get();

        foreach ($cars as $car){
            assert($car instanceof Car);

            $car->calculateAndSaveSpecialEwcCodes();
        }
    }

    public function exportAll()
    {
        return (new AllCarDataExport($this->getFilteredQuery()))->download('osszes_auto_adatok_'.\Str::slug(now()).'.xlsx');
    }

    public function exportCompanyCars()
    {
        return (new AllCarDataExport($this->getFilteredQuery()->whereNotNull("company_name")))->download('ceges_auto_adatok_'.\Str::slug(now()).'.xlsx');
    }

    public function before1989Export()
    {
        return (new AllCarDataExport($this->getFilteredQuery()->where("year", "<=",
            1989)))->download('1989_elotti_autok_'.\Str::slug(now()).'.xlsx');
    }

    public function byCityStatsExport()
    {
        return (new CarStatisticsByCityExport($this->getFilteredQuery()))->download('varosonkenti_statisztika_'.\Str::slug(now()).'.xlsx');
    }

    public function byMakeStatsExport()
    {
        return (new CarStatisticsByMakeExport($this->getFilteredQuery()))->download('markankenti_statisztika_'.\Str::slug(now()).'.xlsx');
    }

    public function destructionNumberExport()
    {
        return (new DestructionNumberExport($this->getFilteredQuery()))->download('bontasi_igazolas_szamok_'.\Str::slug(now()).'.xlsx');
    }

    public function carLabelsExport()
    {
        $path = storage_path('labels/auto_cimkek_'.\Str::slug(now()).'.pdf');
        $pdf = LaravelMpdf::loadHTML(view("exports.labels", ["cars" => $this->getFilteredQuery()->get()])->render());
        $result = $pdf->save($path);
        return response()->download($path,'auto_cimkek_'.\Str::slug(now()).'.pdf');
    }

    public function mount()
    {
        $this->sendStatistics();
    }

    public function getFilteredQuery()
    {
        $query = $this->query();

        if (method_exists($this, 'applySorting')) {
            $query = $this->applySorting($query);
        }

        if (method_exists($this, 'applySearchFilter')) {
            $query = $this->applySearchFilter($query);
        }

        if (!empty($this->engineCodeSearch)){
            $query->where('engine_code', 'LIKE', "%{$this->engineCodeSearch}%");
        }

        return $query;
    }

    public function sendStatistics()
    {
        $query = $this->getFilteredQuery();
        $query->orders = [];

        $this->emit("carsTableRefreshed", [
            "count"             => $query->count(),
            "car_ret_weight"    => $query->sum("retrieved_weight"),
            "car_dry_weight"    => $query->sum("dry_weight"),
            "car_avg_year"      => round($query->avg("year")),
            "car_stats_by_city" => $query->groupBy("city")->selectRaw("1 as local_identifier, city, count(*) as count, sum(retrieved_weight) as sum")->orderBy('sum','desc')->get(),
            "car_stats_by_make" => $query->join("car_models", "car_models.id", "=",
                "cars.car_model_id")->join("car_makes", "car_makes.id", "=",
                "car_models.make_id")->groupBy("car_makes.make")->selectRaw("1 as local_identifier, car_makes.make, count(*) as count, sum(retrieved_weight) as sum")->orderBy('sum','desc')->get(),
        ]);
    }

    public function filters(): array
    {
        return [
            'make_id'                 => Filter::make(__("cars.car_make"))
                                               ->select(
                                                   ['' => __('misc.all')] + CarMake::pluck('make', 'id')->toArray()
                                               ),
            'model_id'                => Filter::make(__("cars.car_model"))
                                               ->select(
                                                   ['' => __('misc.all')] + CarModel::pluck('model', 'id')->toArray()
                                               ),
            'date_of_demolition_from' => Filter::make(__("cars.date_of_demolition")." ".__("misc.from"))
                                               ->date(),
            'date_of_demolition_to'   => Filter::make(__("cars.date_of_demolition")." ".__("misc.to"))
                                               ->date(),
            'year_from'               => Filter::make(__("cars.year")." ".__("misc.from"))->select(
                ["" => __("misc.all")] + Car::orderBy("year")->pluck("year", "year")->toArray()
            ),
            'year_to'                 => Filter::make(__("cars.year")." ".__("misc.to"))->select(
                ["" => __("misc.all")] + Car::orderBy("year", "DESC")->pluck("year", "year")->toArray()
            ),
            'fuel_type_id'            => Filter::make(__("cars.fuel_type_id"))->multiSelect(
                FuelType::pluck("name", "id")->toArray()
            ),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make(__("cars.local_identifier"), 'local_identifier')
                  ->sortable()
                  ->searchable(),
            Column::make(__("cars.car_make"))
                  ->format(function ($s, $f, $row) {
                      return $row->carMake->make;
                  })
                  ->searchable(function (Builder $query, $searchTerm) {
                      $query->orWhereHas("carModel", function ($query) use ($searchTerm) {
                          return $query->whereHas("carMake", function ($query) use ($searchTerm) {
                              return $query->where("make", "LIKE", "%$searchTerm%");
                          });
                      });
                  }),
            Column::make(__("cars.car_model"))
                  ->format(function ($s, $f, $row) {
                      return $row->carModel->model;
                  })
                  ->searchable(function (Builder $query, $searchTerm) {
                      $query->orWhereHas("carModel", function ($query) use ($searchTerm) {
                          return $query->where("model", "LIKE", "%$searchTerm%");
                      });
                  }),
            Column::make(__("cars.year"), 'year')
                  ->sortable()
                  ->searchable(),
            Column::make(__("cars.color_id"))
                ->format(function ($s, $f, $row) {
                    return $row->color->name;
                })
                ->searchable(function (Builder $query, $searchTerm) {
                    $query->orWhereHas("color", function ($query) use ($searchTerm) {
                        return $query->where("name", "LIKE", "%$searchTerm%");
                    });
                }),
            Column::make(__("cars.demolition_certificate_number"), 'demolition_certificate_number')
                ->sortable()
                ->searchable(),
            Column::make(__("cars.vin"), 'vin')
                  ->sortable()
                  ->searchable(),
            Column::make(__("cars.engine_code"), 'engine_code')
                  ->sortable()
                  ->searchable(),
            Column::make(__("cars.fuel_type_id"))
                  ->format(function ($s, $f, $row) {
                      return $row->fuelType->name;
                  })
                  ->searchable(function (Builder $query, $searchTerm) {
                      $query->orWhereHas("fuelType", function ($query) use ($searchTerm) {
                          return $query->where("name", "LIKE", "%$searchTerm%");
                      });
                  }),
            Column::make(__("cars.engine_ccm"), 'engine_ccm')
                  ->sortable()
                  ->searchable(),
            Column::make(__("cars.date_of_demolition"), 'date_of_demolition')
                  ->sortable()
                  ->searchable(),
            Column::make(__("cars.city"), 'city')
                  ->sortable()
                  ->searchable(),
            Column::make('')
                  ->format(function ($row) {
                      return view('cars.includes.actions')
                          ->with("model", $row);
                  })
                  ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Car::query()
                  ->when($this->getFilter("make_id"), function ($query, $make_id) {
                      return $query->whereHas("carModel", function ($query) use ($make_id) {
                          return $query->where("make_id", $make_id);
                      });
                  })
                  ->when($this->getFilter("model_id"), function ($query, $model_id) {
                      return $query->where("car_model_id", $model_id);
                  })
                  ->when($this->getFilter("date_of_demolition_from"), function ($query, $date_of_demolition_from) {
                      return $query->where("date_of_demolition", ">=", $date_of_demolition_from);
                  })
                  ->when($this->getFilter("date_of_demolition_to"), function ($query, $date_of_demolition_to) {
                      return $query->where("date_of_demolition", "<=", $date_of_demolition_to);
                  })
                  ->when($this->getFilter("year_from"), function ($query, $year_from) {
                      return $query->where("year", ">=", $year_from);
                  })
                  ->when($this->getFilter("year_to"), function ($query, $year_to) {
                      return $query->where("year", "<=", $year_to);
                  })
                  ->when($this->getFilter("fuel_type_ids"), function ($query, $fuel_type_ids) {
                      return $query->whereIn("fuel_type_id", $fuel_type_ids);
                  })->when($this->engineCodeSearch, function ($query) {
                        return $query->where('engine_code', 'LIKE', "%{$this->engineCodeSearch}%");
                    });
    }

    public function render()
    {
        $this->sendStatistics();

        return parent::render();
    }
}
