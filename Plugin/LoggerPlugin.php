<?php

namespace Graycore\GraphQlLogger\Plugin;

use Graycore\GraphQlLogger\Api\LogRepositoryInterface;
use Graycore\GraphQlLogger\Api\Data\LogInterfaceFactory as LogFactory;
use Graycore\GraphQlLogger\Model\Config;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Query\QueryProcessor;
use Magento\Framework\GraphQl\Schema;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class LoggerPlugin
{
    private LogRepositoryInterface $logRepository;
    private LogFactory $logFactory;
    private RequestInterface $request;
    private TimezoneInterface $date;
    private Config $config;

    public function __construct(
        RequestInterface $request,
        LogRepositoryInterface $logRepository,
        LogFactory $logFactory,
        TimezoneInterface $date,
        Config $config
    ) {
        $this->request = $request;
        $this->logRepository = $logRepository;
        $this->logFactory = $logFactory;
        $this->date = $date;
        $this->config = $config;
    }

    public function afterProcess(
        QueryProcessor $queryProcessor,
        array $value,
        Schema $schema,
        string $source
    ): array {
        if (!$this->config->isEnabled()) {
            return $value;
        }

        $hash = hash('sha256', $source);

        try {
            $log = $this->logRepository->getByHash($hash);
        } catch (NoSuchEntityException $e) {
            $log = $this->logFactory->create();
        }

        $log->setHash($hash)
            ->setMethod($this->request->getMethod())
            ->setQuery($source)
            ->setUpdated($this->date->date()->format('Y-m-d H:i:s'));
        $this->logRepository->save($log);

        return $value;
    }
}
