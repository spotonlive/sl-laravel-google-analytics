<?php

namespace SpotOnLive\GoogleAnalytics\Services;

use SpotOnLive\GoogleAnalytics\Exceptions\InvalidProviderException;
use SpotOnLive\GoogleAnalytics\Options\AnalyticsServiceOptions;
use Widop\HttpAdapter\CurlHttpAdapter;
use Widop\GoogleAnalytics\Service;
use Widop\GoogleAnalytics\Client;

class AnalyticsService
{
    /** @var AnalyticsServiceOptions */
    protected $options;

    /** @var null|array */
    protected $provider = null;

    /** @var null|Service */
    protected $service = null;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->options = new AnalyticsServiceOptions($config);
    }

    /**
     * Get service
     *
     * @return Service
     */
    public function getService()
    {
        if (! is_null($this->service)) {
            return $this->service;
        }

        $client = $this->getClient();
        $service = new Service($client);

        $this->service = $service;

        return $service;
    }

    /**
     * Get client
     *
     * @return Client
     */
    protected function getClient()
    {
        $provider = $this->getProvider();

        $httpAdapter = new CurlHttpAdapter();
        $client = new Client($provider['clientId'], $provider['certificate'], $httpAdapter);

        return $client;
    }

    /**
     * Set provider
     *
     * @param string $providerName
     * @return array|null
     * @throws InvalidProviderException
     */
    public function setProvider($providerName)
    {
        $providers = $this->getProviders();

        if (! array_key_exists($providerName, $providers)) {
            throw new InvalidProviderException(
                sprintf(
                    'The provider \'%s\' was not found in config/google-analytics.php',
                    $providerName
                )
            );
        }

        $this->provider = $providers[$providerName];
        $this->service = null;

        return $this->getProvider();
    }

    /**
     * Get provider
     *
     * @return array|null
     * @throws InvalidProviderException
     */
    public function getProvider()
    {
        // Set default provider
        if (is_null($this->provider)) {
            $this->setProvider($this->options->get('provider'));
        }

        return $this->provider;
    }

    /**
     * Get providers
     *
     * @return array
     */
    public function getProviders()
    {
        return $this->options->get('providers');
    }
}
