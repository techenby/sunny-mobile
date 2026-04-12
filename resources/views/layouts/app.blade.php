<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="min-h-screen">
        <native:top-bar :title="$title">

        </native:top-bar>

        <main class="nativephp-safe-area">
            {{ $slot }}
        </main>

        <native:bottom-nav gestures-enabled="true">
            <native:bottom-nav-item
                id="dashboard"
                label="Dashboard"
                icon="home"
                :url="route('dashboard')"
                :active="request()->routeIs('dashboard')"
            />
            <native:bottom-nav-item
                id="inventory"
                label="Inventory"
                icon="folder"
                :url="route('inventory.index')"
                :active="request()->routeIs('inventory.*')"
            />
            <native:bottom-nav-item
                id="recipes"
                label="Recipes"
                icon="book-open"
                :url="route('recipes.index')"
                :active="request()->routeIs('recipes.*')"
            />
        </native:bottom-nav>

        @fluxScripts
    </body>
</html>
