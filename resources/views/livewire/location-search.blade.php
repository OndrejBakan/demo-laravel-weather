<!-- container -->
<div class="flex h-screen flex-col p-2 md:flex-row md:items-center bg-slate-500">

    <!-- Current weather -->
    <div class="w-full sm:w-96 flex flex-col p-4 rounded bg-white md:m-2">
        <div class="flex flex-col">
            <div class="w-full">
                <input
                    type="text" placeholder="Location..."
                    class="w-full text-xl text-black font-bold border-b border-gray-200 focus:outline-none"
                    wire:model.debounce.500ms="searchQuery"/>
                <div class="text-sm text-gray-500">před 5 minutami</div>
            </div>

            <!-- Current Weather and Temperature -->
            <div class="flex flex-row items-center divide-x">
                <!-- Icon -->
                <div class="flex-1">
                    <img class="flex-1" src="https://openweathermap.org/img/wn/10d@4x.png" />
                </div>
                
                <!-- Temperatures -->
                <div class="flex-1">
                    <div class="flex flex-col">
                        <div class="text-3xl md:text-5xl font-semibold self-end">-23°C</div>

                        <div class="flex flex-col items-center justify-items-end text-right">
                            <div class="flex flex-row items-center justify-items-end text-right">
                                <div class="basis-2/3">min</div>
                                <div class="basis-1/3">-15 °C</div>
                            </div>

                            <div class="flex flex-row items-center justify-items-end text-right">
                                <div class="basis-2/3">min</div>
                                <div class="basis-1/3">-15 °C</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
