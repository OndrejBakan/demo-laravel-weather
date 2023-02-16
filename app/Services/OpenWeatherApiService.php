<?php

namespace App\Services;

class OpenWeatherApiService
{
    public function getWeatherForCity($city) : array
    {
        return ['city' => $city, 'message' => 'Zima.'];
    }
}