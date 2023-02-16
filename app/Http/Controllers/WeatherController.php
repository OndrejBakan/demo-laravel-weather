<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenWeatherApiService;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather.index');
    }

    public function show(Request $request, $city, OpenWeatherApiService $openWeatherApiService)
    {
        $weatherData = $openWeatherApiService->getWeatherForCity($city);
        
        return view('weather.index')->with('weatherData', $weatherData);
    }
}
