<div>
    <div class="min-h-screen p-2 flex flex-col md:flex-row items-center justify-left bg-gradient-to-b from-cyan-500 to-blue-500">
        <div class="flex flex-col bg-white rounded p-4 m-4 w-full max-w-xs">
            <div class="flex flex-col items-center">
                <div class="w-full flex flex-col items-center h-64">
                    <div class="w-full">
                        <div class="flex flex-col items-center relative">
                            <div class="w-full">
                                <input placeholder="Search by position"
                                    class="font-bold text-xl border-b border-grey-dark w-full focus:outline-0"
                                    wire:model.debounce.100ms="searchQuery">

                            </div>

                            @if ($showResults)
                                <div
                                    class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto">
                                    <div class="flex flex-col w-full">
                                        @foreach ($searchResults as $searchResult)
                                            <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100"
                                                wire:click="locationSelected({{ $searchResult['lat'] }}, {{ $searchResult['lon'] }}, '{{ isset($searchResult['local_names']['cs']) ? $searchResult['local_names']['cs'] : $searchResult['name'] }}')">
                                                <div
                                                    class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                                    <div class="w-6 flex flex-col items-center">
                                                        <div
                                                            class="flex relative w-5 h-5 justify-center items-center m-1 mr-2 w-4 h-4 mt-1">
                                                            <span
                                                                class="fi fi-{{ strtolower($searchResult['country']) }}"></span>
                                                        </div>
                                                    </div>
                                                    <div class="w-full items-center flex">
                                                        <div class="mx-2 -mt-1">{{ isset($searchResult['local_names']['cs']) ? $searchResult['local_names']['cs'] : $searchResult['name'] }}
                                                            <div
                                                                class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">
                                                                {{ $searchResult['country'] }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .top-100 {
                    top: 100%
                }

                .bottom-100 {
                    bottom: 100%
                }

                .max-h-select {
                    max-height: 300px;
                }
            </style>
        </div>

        <div class="flex flex-col md:flex-row overflow-x-auto">
            @if ($locationSelected)
                @foreach ($forecastWeatherData['list'] as $key => $forecastDay)
                    <div class="m-2 flex min-w-sm max-w-sm flex-col rounded bg-white p-4">
                        <div class="flex flex-col items-center">
                            <div class="flex h-64 w-full flex-col items-center">
                                <div class="w-full">
                                    <div class="relative flex flex-col items-center">
                                        <div class="w-full text-xl font-bold">{{ Carbon\Carbon::create($key)->format('l') }}</div>
                                    </div>
                                </div>
                                <div class="w-full divide-y overflow-y-auto">
                                    @foreach ($forecastDay as $forecastHour)
                                        <div class="flex flex-row justify-between items-center h-16">
                                            <div class="basis-1/3">{{ Carbon\Carbon::parse($forecastHour['dt_carbon'])->format('H:i') }}</div>
                                            <div class="basis-1/3">
                                                <img src="https://openweathermap.org/img/wn/{{ $forecastHour['weather'][0]['icon'] }}@2x.png">
                                            </div>
                                            <div class="basis-1/3 text-right pr-1">{{ round($forecastHour['main']['temp']) }} °C</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
