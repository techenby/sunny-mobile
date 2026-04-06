<?php

declare(strict_types=1);
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::splash')->name('splash');

Route::middleware(['guest'])
    ->group(function (): void {
        Route::livewire('login', 'pages::auth.login')->name('login');
        Route::livewire('register', 'pages::auth.register')->name('register');
    });

Route::middleware(['auth', 'verified'])
    ->group(function (): void {
        Route::livewire('dashboard', 'pages::dashboard')->name('dashboard');
    });
