<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="min-h-screen">
        <native:top-bar :title="$title">

        </native:top-bar>

        <native:side-nav gestures-enabled="true">
            <native:side-nav-item
                id="dashboard"
                label="Dashboard"
                icon="home"
                :url="route('dashboard')"
                :active="request()->routeIs('dashboard')"
            />
            <native:side-nav-item
                id="inventory"
                label="Inventory"
                icon="folder"
                :url="route('inventory.index')"
                :active="request()->routeIs('inventory.*')"
            />
            <native:side-nav-item
                id="recipes"
                label="Recipes"
                icon="book-open"
                :url="route('recipes.index')"
                :active="request()->routeIs('recipes.*')"
            />
        </native:side-nav>

        <main class="nativephp-safe-area">
            {{ $slot }}
        </main>

        @fluxScripts
    </body>
</html>
