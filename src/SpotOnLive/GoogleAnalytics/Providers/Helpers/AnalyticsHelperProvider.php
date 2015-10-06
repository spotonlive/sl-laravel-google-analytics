<?php

/**
 * Google analytics integration for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\Assertions
 */

namespace SpotOnLive\GoogleAnalytics\Providers\Helpers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use SpotOnLive\GoogleAnalytics\Helpers\AnalyticsHelper;

class AnalyticsHelperProvider extends ServiceProvider
{
    /**
     * Register helper
     */
    public function register()
    {
        $this->app->bind('SpotOnLive\GoogleAnalytics\Helpers\AnalyticsHelper', function (Application $application) {
            return new AnalyticsHelper();
        });
    }
}
