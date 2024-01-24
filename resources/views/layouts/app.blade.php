<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Laravel App</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Дополнительные метатеги, стили и скрипты могут быть добавлены здесь -->
</head>
<body>
    @yield('content')
    <!-- Дополнительный HTML-код, скрипты и т. д. могут быть добавлены здесь -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
