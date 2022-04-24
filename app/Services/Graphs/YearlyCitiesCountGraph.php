<?php

namespace App\Services\Graphs;

use Carbon\Carbon;

class YearlyCitiesCountGraph
{
    public function query()
    {
        return \DB::table("cars")
            ->select(\DB::raw("city, COUNT(*) as cars_count"))
            ->groupBy(\DB::raw("city"));
    }

    public function getData()
    {
        $thisYear = $this->query()->whereYear("date_of_demolition", Carbon::now()->year)->pluck("cars_count", "city");
        $prevYear = $this->query()->whereYear("date_of_demolition", Carbon::now()->subYear()->year)->pluck("cars_count", "city");

        $cities = $thisYear->keys()->merge($prevYear->keys())->unique();

        $thisYearData = [];
        $prevYearData = [];

        foreach ($cities as $city) {
            $thisYearData[] = $thisYear->get($city, 0);
            $prevYearData[] = $prevYear->get($city, 0);
        }

        $data['labels']   = $cities->flatten();
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
