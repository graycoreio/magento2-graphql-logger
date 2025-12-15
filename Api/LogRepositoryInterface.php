<?php

namespace Graycore\GraphQlLogger\Api;

use Graycore\GraphQlLogger\Api\Data\LogInterface;

interface LogRepositoryInterface
{
    /**
     * Save a log entry
     *
     * @param LogInterface $log
     * @return LogInterface
     */
    public function save(LogInterface $log): LogInterface;

    /**
     * Get a log entry by hash
     *
     * @param string $hash
     * @return LogInterface
     */
    public function getByHash(string $hash): LogInterface;
}
