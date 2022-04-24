<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Seeder;

class FuelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuelTypes = [
            "Benzin",
            "Dízel",
            "Elektromos",
            "Hibrid",
            "Etanol",
            "Gáz",
            "Nem ismert",
        ];
        foreach ($fuelTypes as $fuelType){
            FuelType::create([
                "name" => $fuelType
            ]);
        }
    }
}
