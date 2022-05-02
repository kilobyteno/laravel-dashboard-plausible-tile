<?php

namespace Kilobyteno\PlausibleTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PlausibleTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchDataFromPlausibleCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-plausible-tile'),
        ], 'dashboard-plausible-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-plausible-tile');

        Livewire::component('plausible-tile', PlausibleTileComponent::class);
    }
}
