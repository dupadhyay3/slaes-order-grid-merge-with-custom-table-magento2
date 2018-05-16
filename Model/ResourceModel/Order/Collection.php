<?php

namespace Atharva\OrderMerge\Model\ResourceModel\Order;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {

    protected $_idFieldName = 'odr_id';

    protected function _construct()
    {
        $this->_init('Atharva\OrderMerge\Model\Order', 'Atharva\OrderMerge\Model\ResourceModel\Order');
    }
}