<?php

namespace Graycore\GraphQlLogger\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Log extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('graycore_graphql_log', 'log_id');
    }
}
