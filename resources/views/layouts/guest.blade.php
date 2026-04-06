<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="min-h-screen">
        <main class="nativephp-safe-area">
            {{ $slot }}
        </main>

        @livewireScripts
        @fluxScripts
    </body>
</html>
