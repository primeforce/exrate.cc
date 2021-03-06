<?php

namespace App\Builders;

use App\Exceptions\ExchangerConfigurationNotFoundException;

class CPEndpointBuilder extends AbstractEndpointBuilder
{
    /**
     * CPEndpointBuilder constructor.
     *
     * @throws ExchangerConfigurationNotFoundException
     */
    private function __construct()
    {
        $this->root();
    }

    /**
     * Get root of the CryptoProcessing endpoint.
     *
     * @throws ExchangerConfigurationNotFoundException
     */
    public function root()
    {
        $this->endpoint = $this->getExchangerUrl() . $this->getExchangerPrefix() . $this->getExchangerVersion();
    }

    public static function point()
    {
        return new CPEndpointBuilder();
    }

    /**
     * Get exchanger URL endpoint.
     *
     * @return \Illuminate\Config\Repository|mixed
     * @throws ExchangerConfigurationNotFoundException
     */
    private function getExchangerUrl()
    {
        $exchangerUrl = config('exchanger.api.url');

        if (empty($exchangerUrl)) {
            \Log::error('Exchanger url is not set.');
            throw new ExchangerConfigurationNotFoundException('Exchanger url is not set.');
        }

        return $exchangerUrl;
    }

    private function getExchangerPrefix()
    {
        $exchangerPrefix = config('exchanger.api.prefix');
        return empty($exchangerPrefix) ? '' : '/' . $exchangerPrefix;
    }

    private function getExchangerVersion()
    {
        $exchangerVersion = config('exchanger.api.version');
        return empty($exchangerVersion) ? '' : '/' . $exchangerVersion;
    }
}