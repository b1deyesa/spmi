<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" href="{{ asset('img/logo-sipenjamu.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css">
    <script src="https://kit.fontawesome.com/4419d23bf4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" defer></script>
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    @stack('css')
    @livewireStyles
</head>
<body>
    {{ $slot }}
    @livewireScripts
    @stack('scripts') 
</body>
</html>