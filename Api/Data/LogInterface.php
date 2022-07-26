<?php

namespace Graycore\GraphQlLogger\Api\Data;

interface LogInterface
{
    public const LOG_ID  = 'log_id';
    public const HASH    = 'hash';
    public const METHOD  = 'method';
    public const QUERY   = 'query';
    public const UPDATED = 'updated';

    public function setLogId(int $logId): self;
    public function getLogId(): ?int;
    public function setHash(string $hash): self;
    public function getHash(): string;
    public function setMethod(string $method): self;
    public function getMethod(): string;
    public function setQuery(string $query): self;
    public function getQuery(): string;
    public function setUpdated(string $updated): self;
    public function getUpdated(): string;
}
