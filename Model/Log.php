<?php

namespace Graycore\GraphQlLogger\Model;


use Graycore\GraphQlLogger\Api\Data\LogInterface;
use Graycore\GraphQlLogger\Model\ResourceModel\Log as LogResource;
use Magento\Framework\Model\AbstractModel;

class Log extends AbstractModel implements LogInterface
{
    protected function _construct()
    {
        $this->_init(LogResource::class);
    }

    public function setLogId(int $logId): LogInterface
    {
        $this->setData(self::LOG_ID, $logId);
        return $this;
    }

    public function getLogId(): ?int
    {
        $logId = $this->getData(self::LOG_ID);
        return $logId !== null ? (int) $logId : null;
    }

    public function setHash(string $hash): LogInterface
    {
        $this->setData(self::HASH, $hash);
        return $this;
    }

    public function getHash(): string
    {
        return $this->getData(self::HASH);
    }

    public function setMethod(string $method): LogInterface
    {
        $this->setData(self::METHOD, $method);
        return $this;
    }

    public function getMethod(): string
    {
        return $this->getData(self::METHOD);
    }

    public function setQuery(string $query): LogInterface
    {
        $this->setData(self::QUERY, $query);
        return $this;
    }

    public function getQuery(): string
    {
        return $this->getData(self::QUERY);
    }

    public function setUpdated(string $updated): LogInterface
    {
        $this->setData(self::UPDATED, $updated);
        return $this;
    }

    public function getUpdated(): string
    {
        return $this->getData(self::UPDATED);
    }
}
