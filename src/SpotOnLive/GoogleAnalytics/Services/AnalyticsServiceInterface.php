<?php

namespace SpotOnLive\GoogleAnalytics\Services;

use SpotOnLive\GoogleAnalytics\Exceptions\InvalidProviderException;

interface AnalyticsServiceInterface
{
    /**
     * Set provider
     *
     * @param string $providerName
     * @return array|null
     * @throws InvalidProviderException
     */
    public function setProvider($providerName);

    /**
     * Get provider
     *
     * @return array|null
     * @throws InvalidProviderException
     */
    public function getProvider();

    /**
     * Get providers
     *
     * @return array
     */
    public function getProviders();

    /**
     * @param null|string $id
     */
    public function setSiteId($id);

    /**
     * @return null|string
     */
    public function getSiteId();
}
