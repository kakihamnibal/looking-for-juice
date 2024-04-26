<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use App\Models\Prefecture; 
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Client $client, Prefecture $prefecture, City $city)
    {
        $prefectures = $prefecture->all();
        
        foreach($prefectures->pluck('id') as $prefecture_id)
        {
            $api = 'https://www.reinfolib.mlit.go.jp/ex-api/external/XIT002?area=' .str_pad($prefecture_id, 2, 0, STR_PAD_LEFT);
            $respone_datas = $client->request('GET', $api);
            $respone_bodys = json_decode($respone_datas->getBody()->getContents(), true);
            
            if ($respone_bodys['status'] === 'OK') 
            {
                foreach ($respone_bodys['data'] as $respone_body) 
                {
                    // 都道府県の外部キーを指定して市区町村を登録
                    $city->create
                    ([
                        'prefecture_id' => $prefecture_id,
                        'city_code'     => $respone_body['id'],
                        'city'          => $respone_body['city']
                    ]); 
                }
            }
        }
    }
}
