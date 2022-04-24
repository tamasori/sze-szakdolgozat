<?php

namespace App\Services\Graphs;

use Carbon\Carbon;

class QuarterlyCarsCountGraph
{
    public function query()
    {
        return \DB::table("cars")
            ->select(\DB::raw("QUARTER(date_of_demolition), COUNT(*) as cars_count"))
            ->groupBy(\DB::raw("QUARTER(date_of_demolition)"));
    }

    public function getData()
    {
        $thisYear = $this->query()->whereYear("date_of_demolition", Carbon::now()->year)->pluck("cars_count", "QUARTER(date_of_demolition)");
        $prevYear = $this->query()->whereYear("date_of_demolition", Carbon::now()->subYear()->year)->pluck("cars_count", "QUARTER(date_of_demolition)");

        $data['labels']   = [
            __("dashboard.charts.quarters.first"),
            __("dashboard.charts.quarters.second"),
            __("dashboard.charts.quarters.third"),
            __("dashboard.charts.quarters.fourth"),
        ];
        $data['datasets'][] = [
            'label' => Carbon::now()->year,
            'backgroundColor' => '#0d6efd',
            'color' => '#0d6efd',
            'data' => [
                $thisYear[1] ?? 0,
                $thisYear[2] ?? 0,
                $thisYear[3] ?? 0,
                $thisYear[4] ?? 0,
            ],
        ];
        $data['datasets'][] = [
            'label' => Carbon::now()->subYear()->year,
            'backgroundColor' => '#fd7e14',
            'color' => '#fd7e14',
            'data' => [
                $prevYear[1] ?? 0,
                $prevYear[2] ?? 0,
                $prevYear[3] ?? 0,
                $prevYear[4] ?? 0,
            ],
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
