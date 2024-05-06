<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use App\Models\Prefecture; 
use App\Models\City;
use Illuminate\Support\Facades\Http;

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
            
            $response = $client->request('GET', $api, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => config('services.city_api.city_key')
                ]
            ]);
            
            $respone_bodys = json_decode($response->getBody()->getContents(), true);
            
            if ($respone_bodys['status'] === 'OK') 
            {
                foreach ($respone_bodys['data'] as $respone_body) 
                {
                    $city->create([
                        'prefecture_id' => $prefecture_id,
                        'city_code'     => $respone_body['id'],
                        'city'          => $respone_body['name']
                    ]); 
                }
            }
        }
    }
}
