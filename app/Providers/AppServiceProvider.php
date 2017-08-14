<?php

namespace App\Providers;

use GooglePlacesAPI\Managers\GooglePlacesManager;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GooglePlacesManager::class, function ($app) {
            if (!config("app.app_google_places_api_key")) {
                throw new \Exception("Google Places App key is missing");
            }

            $appKey = config("app.app_google_places_api_key");
            $service = new GooglePlacesManager($appKey);
            $service->setClient(new Client());

            return $service;
        });
    }
}
