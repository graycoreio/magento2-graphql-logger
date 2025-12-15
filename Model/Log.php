<?php

namespace Graycore\GraphQlLogger\Model;

use Graycore\GraphQlLogger\Api\Data\LogInterface;
use Graycore\GraphQlLogger\Model\ResourceModel\Log as LogResource;
use Magento\Framework\Model\AbstractModel;

class Log extends AbstractModel implements LogInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(LogResource::class);
    }

    /**
     * @inheritdoc
     */
    public function setLogId(int $logId): LogInterface
    {
        $this->setData(self::LOG_ID, $logId);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLogId(): ?int
    {
        $logId = $this->getData(self::LOG_ID);
        return $logId !== null ? (int) $logId : null;
    }

    /**
     * @inheritdoc
     */
    public function setHash(string $hash): LogInterface
    {
        $this->setData(self::HASH, $hash);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getHash(): string
    {
        return $this->getData(self::HASH);
    }

    /**
     * @inheritdoc
     */
    public function setMethod(string $method): LogInterface
    {
        $this->setData(self::METHOD, $method);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getMethod(): string
    {
        return $this->getData(self::METHOD);
    }

    /**
     * @inheritdoc
     */
    public function setQuery(string $query): LogInterface
    {
        $this->setData(self::QUERY, $query);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getQuery(): string
    {
        return $this->getData(self::QUERY);
    }

    /**
     * @inheritdoc
     */
    public function setUpdated(string $updated): LogInterface
    {
        $this->setData(self::UPDATED, $updated);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUpdated(): string
    {
        return $this->getData(self::UPDATED);
    }
}
