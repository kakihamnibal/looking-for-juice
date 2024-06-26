<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drinks')->insert([
            [
                'name' => 'オランジーナ'
            ],
            [
                'name' => 'Dr Pepper'
            ],
            [
                'name' => 'メロンソーダ'
            ],
            [
                'name' => 'グレープフルーツジュース'
            ],
            [
                'name' => 'その他'
            ]
            
        ]);
    }
}
