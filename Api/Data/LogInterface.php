<?php

namespace Graycore\GraphQlLogger\Api\Data;

interface LogInterface
{
    public const LOG_ID  = 'log_id';
    public const HASH    = 'hash';
    public const METHOD  = 'method';
    public const QUERY   = 'query';
    public const UPDATED = 'updated';

    /**
     * Set log ID
     *
     * @param int $logId
     * @return self
     */
    public function setLogId(int $logId): self;

    /**
     * Get log ID
     *
     * @return int|null
     */
    public function getLogId(): ?int;

    /**
     * Set hash
     *
     * @param string $hash
     * @return self
     */
    public function setHash(string $hash): self;

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash(): string;

    /**
     * Set method
     *
     * @param string $method
     * @return self
     */
    public function setMethod(string $method): self;

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * Set query
     *
     * @param string $query
     * @return self
     */
    public function setQuery(string $query): self;

    /**
     * Get query
     *
     * @return string
     */
    public function getQuery(): string;

    /**
     * Set updated timestamp
     *
     * @param string $updated
     * @return self
     */
    public function setUpdated(string $updated): self;

    /**
     * Get updated timestamp
     *
     * @return string
     */
    public function getUpdated(): string;
}
