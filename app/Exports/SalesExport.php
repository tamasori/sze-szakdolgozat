<?php

namespace App\Exports;

use App\Models\Substance;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesExport implements FromCollection
{
    use Exportable;

    public $dateFrom = null;
    public $dateTo = null;

    public function __construct($dateFrom = null, $dateTo = null)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo   = $dateTo;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $rows = [
            [
                __("substances.date"),
                __("sales.type"),
                __("substances.mass"),
                __("sales.quantity"),
                __("cars.demolition_certificate_number"),
                __("cars.year"),
                __("cars.car_make"),
                __("substances.part_name"),
                __("sales.quality_color"),
            ],
        ];

        $sales = Substance::with(["car", "ewcCode", "car.carModel"])
            ->whereRelation("ewcCode","code", "=", "R4")
            ->whereHas("car")
            ->orderBy("date")
            ->when($this->dateFrom, fn($query, $dateFrom) => $query->where("date",">=", $dateFrom))
            ->when($this->dateTo, fn($query, $dateTo) => $query->where("date","<=", $dateTo))
            ->get();
        foreach ($sales as $sale){
            $rows[] = [
                $sale->date,
                __("sales.receipt"),
                $sale->mass,
                1,
                $sale->car->demolition_certificate_number,
                $sale->car->year,
                $sale->car->carMake->make,
                $sale->part_name,
                __("sales.quality_color_red")
            ];
        }

        return collect($rows);
    }
}
