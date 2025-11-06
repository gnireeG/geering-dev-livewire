<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

    Route::get('/', \App\Livewire\Home::class)->name('home');
    Route::get('/portfolio', \App\Livewire\Portfolio\Portfolio::class)->name('portfolio');
    Route::get('/portfolio/{slug}', \App\Livewire\Portfolio\Detail::class)->name('portfolio.detail');
    Route::get('/about', \App\Livewire\About::class)->name('about');
    Route::get(LaravelLocalization::transRoute('routes.contact'), \App\Livewire\Contact::class)->name('contact');
    Route::get(LaravelLocalization::transRoute('routes.services'), function(){
        return view('services')->title(__('general.services'));
    })->name('services');
    Route::get(LaravelLocalization::transRoute('routes.privacy'), function(){
        return view('privacy')->title(__('general.privacy_policy'));
    })->name('privacy');
    Route::get(LaravelLocalization::transRoute('routes.imprint'), function(){
        return view('imprint')->title(__('footer.impressum'));
    })->name('imprint');

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
                Route::get('/', \App\Livewire\Admin\Portfolio\Index::class)->name('portfolio.index');
                Route::get('/create', \App\Livewire\Admin\Portfolio\Editportfolio::class)->name('portfolio.create');
                Route::get('/edit/{id}', \App\Livewire\Admin\Portfolio\Editportfolio::class)->name('portfolio.edit');
            });

            Route::group(['prefix' => 'contactforms'], function(){
                Route::get('/', \App\Livewire\Admin\Contactform\Index::class)->name('contactform.index');
                Route::get('/{contactform}', \App\Livewire\Admin\Contactform\Detail::class)->name('contactform.detail');
            });
        });

        if(env('APP_DEBUG') === true) {
            Route::get('/contact-mail/{id}', function ($id) {
                $contactform = App\Models\Contactform::find($id);
    
                return new App\Mail\ContactformReceived($contactform);
            });
        }

    });
});



require __DIR__.'/auth.php';
