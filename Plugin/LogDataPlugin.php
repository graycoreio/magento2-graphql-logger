<?php

namespace Graycore\GraphQlLogger\Plugin;

use Graycore\GraphQlLogger\Model\Config;
use Magento\Framework\App\RequestInterface;
use Magento\GraphQl\Helper\Query\Logger\LogData;

class LogDataPlugin
{
    /**
     * @var Config
     */
    private Config $config;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * Add query to log data
     *
     * @param LogData $logdata
     * @param array $result
     * @param RequestInterface $request
     * @param array $data
     * @return array
     */
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
