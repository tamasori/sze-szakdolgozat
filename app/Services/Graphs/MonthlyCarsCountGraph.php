<?php

namespace App\Services\Graphs;

use Carbon\Carbon;

class MonthlyCarsCountGraph
{
    public function query()
    {
        return \DB::table("cars")
            ->select(\DB::raw("MONTH(date_of_demolition), COUNT(*) as cars_count"))
            ->groupBy(\DB::raw("MONTH(date_of_demolition)"));
    }

    public function getData()
    {
        $thisYear = $this->query()->whereYear("date_of_demolition", Carbon::now()->year)->pluck("cars_count", "MONTH(date_of_demolition)");
        $prevYear = $this->query()->whereYear("date_of_demolition", Carbon::now()->subYear()->year)->pluck("cars_count", "MONTH(date_of_demolition)");

        $data['labels']   = [
            "Január",
            "Február",
            "Március",
            "Április",
            "Május",
            "Június",
            "Július",
            "Augusztus",
            "Szeptember",
            "Október",
            "November",
            "December",
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
                $thisYear[5] ?? 0,
                $thisYear[6] ?? 0,
                $thisYear[7] ?? 0,
                $thisYear[8] ?? 0,
                $thisYear[9] ?? 0,
                $thisYear[10] ?? 0,
                $thisYear[11] ?? 0,
                $thisYear[12] ?? 0,
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
                $prevYear[5] ?? 0,
                $prevYear[6] ?? 0,
                $prevYear[7] ?? 0,
                $prevYear[8] ?? 0,
                $prevYear[9] ?? 0,
                $prevYear[10] ?? 0,
                $prevYear[11] ?? 0,
                $prevYear[12] ?? 0,
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
