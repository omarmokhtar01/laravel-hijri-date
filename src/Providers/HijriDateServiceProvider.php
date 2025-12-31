<?php
namespace OmarMokhtar\HijriDate\Providers;

use Illuminate\Support\ServiceProvider;
use OmarMokhtar\HijriDate\Services\HijriDateService;

class HijriDateServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/hijri-date.php',
            'hijri-date'
        );

        $this->app->singleton(HijriDateService::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/hijri-date.php' =>
            config_path('hijri-date.php'),
        ]);
    }
}
