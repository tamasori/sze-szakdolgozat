<?php

namespace App\Services\Graphs;

use Carbon\Carbon;

class YearlyMakesCountGraph
{
    public function query()
    {
        return \DB::table("cars")
            ->join("car_models", "cars.car_model_id", "=", "car_models.id")
            ->join("car_makes", "car_models.make_id", "=", "car_makes.id")
            ->select(\DB::raw("car_makes.make, COUNT(*) as cars_count"))
            ->groupBy(\DB::raw("car_makes.make"));
    }

    public function getData()
    {
        $thisYear = $this->query()->whereYear("date_of_demolition", Carbon::now()->year)->pluck("cars_count", "car_makes.make");
        $prevYear = $this->query()->whereYear("date_of_demolition", Carbon::now()->subYear()->year)->pluck("cars_count", "car_makes.make");

        $makes = $thisYear->keys()->merge($prevYear->keys())->unique();

        $thisYearData = [];
        $prevYearData = [];

        foreach ($makes as $make) {
            $thisYearData[] = $thisYear->get($make, 0);
            $prevYearData[] = $prevYear->get($make, 0);
        }

        $data['labels']   = $makes->flatten();
        $data['datasets'][] = [
            'label' => Carbon::now()->year,
            'backgroundColor' => '#0d6efd',
            'color' => '#0d6efd',
            'data' => $thisYearData,
        ];
        $data['datasets'][] = [
            'label' => Carbon::now()->subYear()->year,
            'backgroundColor' => '#fd7e14',
            'color' => '#fd7e14',
            'data' => $prevYearData,
        ];

        return $data;
    }

    public function getConfig()
    {
        return [
            "type" => "bar",
            "data" => $this->getData(),
            "options" => [
                "responsive" => true,
                "legend" => [
                    "display" => true
                ],
                "scales" => [
                    "yAxes" => [
                        [
                            "ticks" => [
                                "beginAtZero" => true
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
