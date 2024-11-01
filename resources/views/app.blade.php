<!DOCTYPE html>
<html>
@routes
<head>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/ts/app.ts'])
    @endif
    @inertiaHead
</head>
<body>
    @inertia
</body>
</html>
