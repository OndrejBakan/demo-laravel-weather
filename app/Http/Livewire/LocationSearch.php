<?php

namespace App\Http\Livewire;

use App\Services\OpenWeatherApiService;
use Carbon\Carbon;
use Livewire\Component;

class LocationSearch extends Component
{
    public $searchQuery = '';
    public $searchResults = [];

    public $showResults = false;
    public $locationSelected = false;

    public $currentWeatherData = [];
    public $forecastWeatherData = [];

    private $openWeatherApiService;

    public function boot(OpenWeatherApiService $openWeatherApiService)
    {
        $this->openWeatherApiService = $openWeatherApiService;
    }

    public function render()
    {
        return view('livewire.location-search');
    }

    public function updatedSearchQuery()
    {  
        if (strlen($this->searchQuery) > 2)
        {
            $this->searchResults = $this->openWeatherApiService->getCoordinatesByLocationName($this->searchQuery);
            $this->showResults = true;
        }
        
    }

    public function locationSelected($lat, $lon)
    {
        
        $this->currentWeatherData = $this->openWeatherApiService->getCurrentWeatherByCoordinates($lat, $lon);
        $this->forecastWeatherData = $this->prepareForecastData($this->openWeatherApiService->getForecastByCoordinates($lat, $lon));

        $this->showResults = false;
        $this->locationSelected = true;
        $this->dispatchBrowserEvent('location-selected');
    }

    private function prepareForecastData($forecastWeatherData)
    {
        $forecastWeatherData['list'] = collect($forecastWeatherData['list']);

        // Add a Carbon to each Forecast item
        $forecastWeatherData['list']->transform(function (array $item, int $key) use ($forecastWeatherData) {
            $item['dt_carbon'] = Carbon::createFromTimestamp($item['dt'], $forecastWeatherData['city']['timezone'] / 3600);
            return $item;
        });

        // Group Forecasts by days (TBH I don't know difference between groupBy and mapToGroups)
        $forecastWeatherData['list'] = $forecastWeatherData['list']->groupBy(function (array $item, int $key) {
            return $item['dt_carbon']->toDateString();
        });

        return $forecastWeatherData;
    }
}
