<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Livewire\Livewire;

Route::post('/theme', function(){
    $theme = request()->input('theme', 'light');
    session(['theme' => $theme]);
    return response()->json(['status' => 'success', 'theme' => $theme]);
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function(){

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });

    // NEW
    Route::group(['prefix' => 'new'], function () {
        Route::get('/', \App\Livewire\Home::class)->name('home');
        Route::get('/portfolio', \App\Livewire\Portfolio::class)->name('portfolio');
        Route::get('/portfolio/{portfolio}', \App\Livewire\PortfolioDetail::class)->name('portfolio.detail');
        Route::get('/about', \App\Livewire\About::class)->name('about');
        Route::get('/contact', \App\Livewire\Contact::class)->name('contact');
    });


    // OLD

    Route::get('/', function () {
        return view('welcome');
    })->name('home-old');


    // AUTH

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
