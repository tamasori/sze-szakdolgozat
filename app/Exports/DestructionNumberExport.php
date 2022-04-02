<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DestructionNumberExport implements FromCollection
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
                __('cars.car_make'),
                __('cars.car_model'),
                __('cars.year'),
                __('cars.fuel_type_id'),
                __("cars.color_id"),
                __('cars.demolition_certificate_number'),
            ],
        ]);

        return $rows->merge($this->query->join("fuel_types", "fuel_types.id", "=", "cars.fuel_type_id")
                                        ->join("car_models", "car_models.id", "=", "cars.car_model_id")
                                        ->join("car_makes", "car_makes.id", "=", "car_models.make_id")
                                        ->join("colors", "colors.id", "=", "cars.color_id")
                                        ->selectRaw("car_makes.make as car_make, car_models.model as car_model, cars.year, fuel_types.name as fuel_type, colors.name as color, cars.demolition_certificate_number")
                                        ->orderBy("car_makes.make")
                                        ->orderBy("car_models.model")
                                        ->orderBy("cars.year")
                                        ->get());
    }
}
