<?php

namespace SpotOnLive\GoogleAnalyticsTest\Facades\Helpers;

use PHPUnit_Framework_TestCase;

class AnalyticsHelperFacadeTest extends PHPUnit_Framework_TestCase
{
    /** @var \SpotOnLive\GoogleAnalytics\Facades\Helpers\AnalyticsHelperFacade */
    protected $facade;

    public function setUp()
    {
        $facade = new \SpotOnLive\GoogleAnalytics\Facades\Helpers\AnalyticsHelperFacade();
        $this->facade = $facade;
    }

    public function testMethodGetFacadeAccessor()
    {
        $method = $this->getMethod('getFacadeAccessor');
        $obj = new $this->facade;
        $result = $method->invokeArgs($obj, []);

        $this->assertEquals('SpotOnLive\GoogleAnalytics\Helpers\AnalyticsHelper', $result);
    }

    /**
     * Get protected/private method from facade
     *
     * @param $name
     * @return \ReflectionMethod
     */
    protected function getMethod($name)
    {
        $class = new \ReflectionClass(get_class($this->facade));

        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}
