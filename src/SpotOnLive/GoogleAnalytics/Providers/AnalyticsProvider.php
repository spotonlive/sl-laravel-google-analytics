<?php

/**
 * Google Analytics integration for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\GoogleAnalytics
 */

namespace SpotOnLive\GoogleAnalytics\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use SpotOnLive\GoogleAnalytics\Exceptions\IllegalConfigurationException;
use SpotOnLive\GoogleAnalytics\Helpers\AnalyticsHelper;
use SpotOnLive\GoogleAnalytics\Services\AnalyticsService;

class AnalyticsProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../../config/config.php' => config_path('google-analytics.php'),
        ]);
    }

    /**
     * Register service
     */
    public function register()
    {
        // Service
        $this->app->bind('SpotOnLive\GoogleAnalytics\Services\AnalyticsService', function (Application $app) {
            $config = config('google-analytics');

            if (is_null($config)) {
                throw new IllegalConfigurationException('Please run \'php artisan vendor:publish\'');
            }

            return new AnalyticsService($config);
        });

        // Helper
        $this->app->bind('SpotOnLive\GoogleAnalytics\Helpers\AnalyticsHelper', function (Application $application) {
            return new AnalyticsHelper();
        });

        $this->mergeConfig();
    }

    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../config/config.php',
            'google-analytics'
        );
    }
}
