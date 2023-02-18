<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url({{ asset('assets/img/background.webp') }})">
        <div class="flex flex-col bg-white rounded p-4 w-full max-w-xs">
            <input type="text" class="font-bold text-xl" value="{{ $weatherData['name'] }}">
            <div class="text-sm text-gray-500">
                {{ Carbon\Carbon::createFromTimestamp($weatherData['dt'], $weatherData['timezone'] / 3600)->locale('cs')->diffForHumans() }}
            </div>
            <div class="mt-6 text-6xl self-center inline-flex items-center justify-center rounded-lg text-indigo-400 h-24 w-24">
                <img src="https://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}@4x.png">
            </div>
            <div class="flex flex-row items-center justify-center mt-6">
                <div class="font-medium text-6xl">{{ round($weatherData['main']['temp']) }}°C</div>
                <div class="flex flex-col items-left ml-6">
                    <div>{{ $weatherData['main']['temp'] }}</div>
                    <div class="mt-1">
                        <span class="text-sm text-right">
                            <span class="text-sm text-red-500"><i class="fas fa-arrow-up"></i></span>
                        </span>
                        <span class="text-sm font-light text-gray-500">{{ round($weatherData['main']['temp_max']) }}°C</span>
                    </div>
                    <div>
                        <span class="text-sm">
                            <span class="text-sm text-blue-500"><i class="fas fa-arrow-down"></i></span>
                        </span>
                        <span class="text-sm font-light text-gray-500">{{ round($weatherData['main']['temp_min']) }}°C</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-row justify-between mt-6">
                <div class="flex flex-col items-center">
                    <div class="font-medium text-sm">Vítr</div>
                    <div class="text-sm text-gray-500">{{ number_format($weatherData['wind']['speed'], 1, ',') }} m/s</div>
                </div>
                <div class="flex flex-col items-center">
                    <div class="font-medium text-sm">Vlhkost</div>
                    <div class="text-sm text-gray-500">{{ number_format($weatherData['main']['humidity'], 0) }} %</div>
                </div>
                <div class="flex flex-col items-center">
                    <div class="font-medium text-sm">Viditelnost</div>
                    <div class="text-sm text-gray-500">{{ number_format($weatherData['visibility'] / 1000, 1, ',') }} km</div>
                </div>
            </div>
        </div>
    </div>

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</body>

</html>