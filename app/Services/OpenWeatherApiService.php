<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherApiService
{
    public $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPEN_WEATHER_API_KEY');
    }

    public function getWeatherForCity($city)
    {
        $url = sprintf('http://api.openweathermap.org/data/2.5/weather?q=%s&APPID=%s', $city, $this->apiKey);

        $response = Http::get($url);
        
        return $response->json();
    }
}