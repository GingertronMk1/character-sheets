<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
    @endif
</head>
<body>
<header>
    <h1>
        Jack's Character Sheet thing that he made for some reason
    </h1>
</header>
<div class="container">
    @yield('content')
</div>
</body>
</html>
