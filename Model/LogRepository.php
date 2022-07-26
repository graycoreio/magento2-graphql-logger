<?php

namespace Graycore\GraphQlLogger\Model;

use Graycore\GraphQlLogger\Api\Data\LogInterface;
use Graycore\GraphQlLogger\Api\Data\LogInterfaceFactory as LogFactory;
use Graycore\GraphQlLogger\Api\LogRepositoryInterface;
use Graycore\GraphQlLogger\Model\ResourceModel\Log as LogResource;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

class LogRepository implements LogRepositoryInterface
{
    private LogFactory $logFactory;
    private LogResource $logResource;
    private LoggerInterface $logger;

    public function __construct(LogFactory $logFactory, LogResource $logResource, LoggerInterface $logger)
    {
        $this->logFactory = $logFactory;
        $this->logResource = $logResource;
        $this->logger = $logger;
    }

    public function save(LogInterface $log): LogInterface
    {
        try {
            $this->logResource->save($log);
        } catch (\Exception $e) {
            $this->logger->warning('Unable to log query.', ['message' => $e->getMessage()]);
        }
        return $log;
    }

    public function getByHash(string $hash): LogInterface
    {
        /** @var LogInterface $log */
        $log = $this->logFactory->create();
        $this->logResource->load($log, $hash, LogInterface::HASH);
        if ($log->getLogId() === null) {
            throw new NoSuchEntityException(__('No log exists for specified hash.'));
        }
        return $log;
    }
}
