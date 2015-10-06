<?php

namespace SpotOnLive\GoogleAnalytics\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class AnalyticsHelperFacade extends Facade
{
    /**
     * Name of the binding container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SpotOnLive\GoogleAnalytics\Helpers\AnalyticsHelper';
    }
}
