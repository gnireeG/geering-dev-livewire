<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Blade directive for timezone conversion
        \Illuminate\Support\Facades\Blade::directive('userdate', function ($expression) {
            return "<?php echo \App\Helpers\TimezoneHelper::toUserTimezone($expression)->format('d.m.Y H:i'); ?>";
        });

        \Illuminate\Support\Facades\Blade::directive('userdaterelative', function ($expression) {
            return "<?php echo \App\Helpers\TimezoneHelper::toUserTimezone($expression)->diffForHumans(); ?>";
        });
    }
}
