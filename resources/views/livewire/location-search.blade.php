<div
    class="min-h-screen flex flex-row items-center justify-left bg-cover bg-center"
    style="background-image: url({{ asset('assets/img/background.webp') }})">
    <div class="flex flex-col bg-white rounded p-4 m-4 w-full max-w-xs">
        <div class="flex flex-col items-center">
            <div class="w-full flex flex-col items-center h-64">
                <div class="w-full px-4">
                    <div class="flex flex-col items-center relative">
                        <div class="w-full">
                            <input placeholder="Search by position"
                                class="font-bold text-xl border-b border-grey-dark focus:outline-0"
                                wire:model.debounce.500ms="searchQuery">

                        </div>

                        @if ($showResults)
                            <div
                                class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                                <div class="flex flex-col w-full">
                                    @foreach ($searchResults as $searchResult)
                                        <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100"
                                            wire:click="locationSelected({{ $searchResult['lat'] }}, {{ $searchResult['lon'] }})">
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
                                                    <div class="mx-2 -mt-1">{{ $searchResult['name'] }}
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

    <button @click="animate()">Toggle</button>

    @if ($locationSelected)
    @foreach ($forecastWeatherData['list'] as $key => $forecastDay)
        <div class="flex flex-col bg-white rounded p-4 m-2 w-full max-w-xs" x-show="open"
            x-transition
            x-transition.duration.1000ms>
            <div class="flex flex-col items-center">
                <div class="w-full flex flex-col items-center h-64">
                    <div class="w-full px-4">
                        <div class="flex flex-col items-center relative">
                            <div class="w-full">
                                {{ $key }}
                            </div>
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
        @endforeach
        @endif
</div>
