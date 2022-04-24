<?php

namespace Database\Seeders;

use App\Models\CarMake;
use App\Models\CarModel;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            "Audi" => [
                "A1",
                "A2",
                "A3",
                "A4",
                "A5",
                "A6",
                "A7",
                "A8",
                "S1",
                "S2",
                "S3",
                "S4",
                "S5",
                "S6",
                "S7",
                "S8",
                "RS1",
                "RS2",
                "RS3",
                "RS4",
                "RS5",
                "RS6",
                "RS7",
                "RS8",
                "TT",
            ],
            "Volkswagen" => [
                "EOS",
                "Golf",
                "Passat",
                "Caddy",
                "Jetta"
            ],
            "BMW" => [
                "320d",
                "330d",
                "320i",
                "316i",
                "318i"
            ],
        ];
        foreach ($cars as $make => $models){
            $make = CarMake::create([
                "make" => $make
            ]);
            foreach($models as $model){
                CarModel::create([
                    "make_id" => $make->getKey(),
                    "model" => $model
                ]);
            }

        }
    }
}
