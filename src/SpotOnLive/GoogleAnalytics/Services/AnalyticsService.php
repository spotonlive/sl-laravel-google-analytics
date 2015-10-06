<?php

namespace SpotOnLive\GoogleAnalytics\Services;

use DateTime;
use SpotOnLive\GoogleAnalytics\Adapters\Auth\AuthAdapterInterface;
use SpotOnLive\GoogleAnalytics\Exceptions\InvalidAdapterException;
use SpotOnLive\GoogleAnalytics\Exceptions\InvalidProviderException;
use SpotOnLive\GoogleAnalytics\Options\AnalyticsServiceOptions;

class AnalyticsService implements AnalyticsServiceInterface
{
    /** @var AnalyticsServiceOptions */
    protected $options;

    /** @var null|array */
    protected $provider = null;

    /** @var null|string */
    protected $siteId = null;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->options = new AnalyticsServiceOptions($config);
    }

    /**
     * Get visits
     *
     * @param DateTime $start
     * @param DateTime $end
     * @return integer
     */
    public function getVisits(DateTime $start, DateTime $end)
    {
    }

    /**
     * Get client
     *
     * @throws InvalidAdapterException
     */
    protected function getClient()
    {
        $provider = $this->provider;
        $adapter = $this->getAdapter($provider);
    }

    /**
     * Get adapter from provider
     *
     * @param array $provider
     * @return AuthAdapterInterface
     * @throws InvalidAdapterException
     */
    protected function getAdapter(array $provider)
    {
        /** @var string $adapterName */
        $adapterName = $provider['auth'];

        if (! class_exists($adapterName)) {
            throw new InvalidAdapterException(
                sprintf(
                    'The adapter class \'%s\' was not found',
                    $adapterName
                )
            );
        }

        /** @var AuthAdapterInterface $adapter */
        $adapter = new $adapterName;

        if (! $adapter instanceof AuthAdapterInterface) {
            throw new InvalidAdapterException(
                sprintf(
                    'The adapter class \'%s\' must be an instance of \'%s\'',
                    $adapterName,
                    AuthAdapterInterface::class
                )
            );
        }

        return $adapter;
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

    /**
     * @return null|string
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * @param null|string $siteId
     */
    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;
    }
}
