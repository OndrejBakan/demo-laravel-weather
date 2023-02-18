<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css" integrity="sha512-uvXdJud8WaOlQFjlz9B15Yy2Au/bMAvz79F7Xa6OakCl2jvQPdHD0hb3dEqZRdSwG4/sknePXlE7GiarwA/9Wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>

<body>
    <div class="min-h-screen flex-row items-left justify-left bg-cover bg-center"
        x-data="animation()"
        @location-selected.window="animate()">

        <livewire:location-search>

    </div>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    @livewireScripts
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('animation', () => ({
                open: false,
                animate() {
                    if (this.open) {
                        setTimeout(() => this.open = false, 1000);
                        setTimeout(() => this.open = true, 2000);
                    } else {
                        setTimeout(() => this.open = true, 1000);
                    }
                },
            }))
        })
    </script>
</body>

</html>