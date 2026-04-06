<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="min-h-screen">
        <main class="nativephp-safe-area bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 pt-12">
            <div class="flex flex-col gap-2 w-full">
                <div class="flex items-center justify-center gap-2 font-medium mb-6">
                    <flux:avatar :src="asset('icon.png')" />
                    <flux:heading size="xl">{{ config('app.name', 'Laravel') }}</flux:heading>
                </div>

                {{ $slot }}
            </div>
        </main>

        @livewireScripts
        @fluxScripts
    </body>
</html>
