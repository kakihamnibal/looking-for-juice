<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PrefectureSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(DrinkSeeder::class);
    
        $this->call([
            PrefectureSeeder::class,
            CitySeeder::class
        ]);
    }
}
