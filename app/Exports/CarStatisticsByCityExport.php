<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class CarStatisticsByCityExport implements FromCollection
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
                __("cars.city"),
                __("cars.statistics.count"),
                __("cars.statistics.retrieved_weight_sum"),
            ],
        ]);

        return $rows->mergeRecursive($this->query
            ->groupBy("city")
            ->selectRaw("MIN(local_identifier) as local_identifier, city, count(*) as count, sum(retrieved_weight) as sum")
            ->get()
            ->map(function ($row) {
                return [
                    $row->city,
                    $row->count,
                    $row->sum,
                ];
            }));
    }
}
