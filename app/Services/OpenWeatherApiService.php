<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
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
        $response = Cache::remember($city, 5, function() use ($city) {
            $url = sprintf('http://api.openweathermap.org/data/2.5/weather?q=%s&APPID=%s&units=metric', $city, $this->apiKey);

            return Http::withUrlParameters([
                'base'      => 'http://api.openweathermap.org/data',
                'version'   => '2.5',
                'endpoint'  => 'weather',
                'q'         => $city,
                'APPID'     => $this->apiKey,
                'units'     => 'metric',
            ])
            ->get('{+base}/{version}/{endpoint}?q={q}&APPID={APPID}&units={units}')
            ->json();
        });

        return $response;
    }
}