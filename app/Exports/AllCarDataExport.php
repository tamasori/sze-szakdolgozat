<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllCarDataExport implements FromCollection
{
    use Exportable;

    private $query;

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
                __("cars.local_identifier"),
                __("cars.demolition_certificate_number"),
                __("cars.date_of_demolition"),
                __("cars.zip"),
                __("cars.city"),
                __("cars.company_name"),
                __("cars.kuj_number"),
                __("cars.ktj_number"),
                __("cars.car_make"),
                __("cars.car_model"),
                __("cars.year"),
                __("cars.fuel_type_id"),
                __("cars.vin"),
                __("cars.engine_code"),
                __("cars.engine_ccm"),
                __("cars.power"),
                __("cars.color_id"),
                __("cars.own_weight"),
                __("cars.retrieved_weight"),
                __("cars.dry_weight"),
                __("cars.note"),
            ],
        ]);

        $carData = $this->query
            ->join("fuel_types", "fuel_types.id", "=", "cars.fuel_type_id")
            ->join("car_models", "car_models.id", "=", "cars.car_model_id")
            ->join("car_makes", "car_makes.id", "=", "car_models.make_id")
            ->join("colors", "colors.id", "=", "cars.color_id")
            ->selectRaw("
            cars.local_identifier,
            cars.demolition_certificate_number,
            cars.date_of_demolition,
            cars.zip,
            cars.city,
            cars.company_name,
            cars.kuj_number,
            cars.ktj_number,
            car_makes.make as car_make,
            car_models.model as car_model,
            cars.year,
            fuel_types.name as fuel_type_id,
            cars.vin,
            cars.engine_code,
            cars.engine_ccm,
            cars.power,
            colors.name as color_id,
            cars.own_weight,
            cars.retrieved_weight,
            cars.dry_weight,
            cars.note")->get()->toArray();

        return $rows->mergeRecursive($carData);
    }
}
