<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

    @include('dashboard.partials.nav-header-main')

    <div class="container">

        @include('dashboard.partials.alert-message')

        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    
</body>
</html>