<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            "Piros",
            "Kék",
            "Fekete",
            "Fehér",
            "Sárga",
            "Szürke",
            "Lila",
            "Ezüst",
            "Arany",
            "Narancssárga",
            "Zöld"
        ];
        foreach ($colors as $color){
            Color::create([
                "name" => $color
            ]);
        }
    }
}
