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

    public function getCurrentWeatherByCoordinates($lat, $lon)
    {
        $response = Cache::remember($lat . ';' . $lon . 'currentWeather', 5, function() use ($lat, $lon) {
            return Http::withUrlParameters([
                'base'      => 'http://api.openweathermap.org/data',
                'version'   => '2.5',
                'endpoint'  => 'weather',
                'lat'       => $lat,
                'lon'       => $lon,
                'units'     => 'metric',
                'APPID'     => $this->apiKey,
                
            ])
            ->get('{+base}/{version}/{endpoint}?lat={lat}&lon={lon}&units={units}&APPID={APPID}')
            ->json();
        });

        return $response;
    }

    public function getForecastByCoordinates($lat, $lon)
    {
        $response = Cache::remember($lat . ';' . $lon . 'forecast', 5, function() use ($lat, $lon) {
            return Http::withUrlParameters([
                'base'      => 'http://api.openweathermap.org/data',
                'version'   => '2.5',
                'endpoint'  => 'forecast',
                'lat'       => $lat,
                'lon'       => $lon,
                'units'     => 'metric',
                'APPID'     => $this->apiKey,
                
            ])
            ->get('{+base}/{version}/{endpoint}?lat={lat}&lon={lon}&units={units}&APPID={APPID}')
            ->collect();
        });

        return $response;
    }

    public function getCoordinatesByLocationName($query)
    {
        return Http::withUrlParameters([
            'base'      => 'http://api.openweathermap.org/geo',
            'version'   => '1.0',
            'endpoint'  => 'direct',
            'q'         => $query,
            'limit'     => 5,
            'APPID'     => $this->apiKey
        ])
        ->get('{+base}/{version}/{endpoint}?q={q}&limit={limit}&APPID={APPID}')
        ->json();
    }

}