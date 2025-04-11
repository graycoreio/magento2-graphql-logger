<?php

namespace Graycore\GraphQlLogger\Plugin;

use Graycore\GraphQlLogger\Model\Config;
use Magento\Framework\App\RequestInterface;
use Magento\GraphQl\Helper\Query\Logger\LogData;

class LogDataPlugin
{
    private Config $config;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    public function afterGetLogData(
        LogData $logdata,
        array $result,
        RequestInterface $request,
        array $data
    ): array {
        if (!$this->config->isEnabled()) {
            return $result;
        }

        /**
         * Add the query to the data.
         */
        $result['query'] = $data['query'];
        return $result;
    }
}
