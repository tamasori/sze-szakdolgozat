<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new UserTableSeeder())->run();
        (new ColorsTableSeeder())->run();
        (new FuelTypeTableSeeder())->run();
        (new CarsSeeder())->run();
        (new EwcCodeSeeder())->run();
    }
}
