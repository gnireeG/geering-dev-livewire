<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Livewire\Livewire;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function(){

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::redirect('settings', 'settings/profile');

        Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
        Volt::route('settings/password', 'settings.password')->name('settings.password');
        Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

        Route::group(['prefix' => 'admin'], function() {
            Route::group(['prefix' => 'portfolio'], function(){
                Route::get('/', \App\Livewire\Portfolio\Index::class)->name('portfolio.index');
                Route::get('/create', \App\Livewire\Portfolio\Editportfolio::class)->name('portfolio.create');
                Route::get('/edit/{id}', \App\Livewire\Portfolio\Editportfolio::class)->name('portfolio.edit');
            });
        });
    });
});



require __DIR__.'/auth.php';
