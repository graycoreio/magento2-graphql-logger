<?php

namespace Graycore\GraphQlLogger\Logger;

use Graycore\GraphQlLogger\Model\Config;
use Magento\GraphQl\Model\Query\Logger\LoggerInterface;

use Graycore\GraphQlLogger\Api\LogRepositoryInterface;
use Graycore\GraphQlLogger\Api\Data\LogInterfaceFactory as LogFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class Logger implements LoggerInterface
{
    /**
     * @var LogRepositoryInterface
     */
    private LogRepositoryInterface $logRepository;

    /**
     * @var LogFactory
     */
    private LogFactory $logFactory;

    /**
     * @var TimezoneInterface
     */
    private TimezoneInterface $date;

    /**
     * @var Config
     */
    private Config $config;

    /**
     * @param LogRepositoryInterface $logRepository
     * @param LogFactory $logFactory
     * @param TimezoneInterface $date
     * @param Config $config
     */
    public function __construct(
        LogRepositoryInterface $logRepository,
        LogFactory $logFactory,
        TimezoneInterface $date,
        Config $config
    ) {
        $this->logRepository = $logRepository;
        $this->logFactory = $logFactory;
        $this->date = $date;
        $this->config = $config;
    }

    /**
     * @inheritdoc
     */
    public function execute(array $queryDetails)
    {
        if (!$this->config->isEnabled()) {
            return;
        }

        $hash = hash('sha256', $queryDetails['query']);

        try {
            $log = $this->logRepository->getByHash($hash);
        } catch (NoSuchEntityException $e) {
            $log = $this->logFactory->create();
        }

        $log->setHash($hash)
            ->setMethod($queryDetails[LoggerInterface::HTTP_METHOD])
            ->setQuery($queryDetails['query'])
            ->setUpdated($this->date->date()->format('Y-m-d H:i:s'));
        $this->logRepository->save($log);
    }
}
