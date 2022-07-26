<?php

namespace Graycore\GraphQlLogger\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    private const CONFIG_PATH_GRAPHQL_LOGGER_ENABLED = 'graphql/logger/enabled';

    private ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled(): bool
    {
        return (bool) $this->scopeConfig->getValue(self::CONFIG_PATH_GRAPHQL_LOGGER_ENABLED);
    }
}
