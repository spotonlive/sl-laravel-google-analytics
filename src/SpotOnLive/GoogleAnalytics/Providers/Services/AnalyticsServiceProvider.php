<?php

/**
 * Google Analytics integration for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\GoogleAnalytics
 */

namespace SpotOnLive\Analytics\Providers\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use SpotOnLive\GoogleAnalytics\Exceptions\IllegalConfigurationException;
use SpotOnLive\GoogleAnalytics\Services\AnalyticsService;

class AnalyticsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../../../config/config.php' => config_path('google-analytics.php'),
        ]);
    }

    /**
     * Register service
     */
    public function register()
    {
        $this->app->bind('SpotOnLive\GoogleAnalytics\Services\AnalyticsService', function (Application $app) {
            $config = config('google-analytics');

            if (is_null($config)) {
                throw new IllegalConfigurationException('Please run \'php artisan vendor:publish\'');
            }

            return new AnalyticsService($config);
        });

        $this->mergeConfig();
    }

    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../../config/config.php',
            'google-analytics'
        );
    }
}
