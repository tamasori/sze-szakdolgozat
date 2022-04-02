<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class CarStatisticsByMakeExport implements FromCollection
{
    use Exportable;

    public $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $rows = collect([
            [
                __("cars.car_make"),
                __("cars.statistics.count"),
                __("cars.statistics.retrieved_weight_sum"),
            ],
        ]);

        return $rows->mergeRecursive($this->query
            ->join("car_models", "car_models.id", "=", "cars.car_model_id")
            ->join("car_makes", "car_makes.id", "=", "car_models.make_id")
            ->groupBy("car_makes.make")
            ->selectRaw("MIN(local_identifier) as local_identifier, car_makes.make, count(*) as count, sum(retrieved_weight) as sum")
            ->get()
            ->map(function ($row) {
                return [
                    $row->make,
                    $row->count,
                    $row->sum,
                ];
            }));
    }
}
