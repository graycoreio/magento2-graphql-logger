<?php

namespace Graycore\GraphQlLogger\Api;

use Graycore\GraphQlLogger\Api\Data\LogInterface;

interface LogRepositoryInterface
{
    public function save(LogInterface $log): LogInterface;
    public function getByHash(string $hash): LogInterface;
}
