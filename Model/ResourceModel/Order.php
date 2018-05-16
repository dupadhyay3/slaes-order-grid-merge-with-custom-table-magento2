<?php

namespace Atharva\OrderMerge\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Order extends AbstractDb {

    public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}

    protected function _construct() {
        $this->_init('atharva_ordermerge', 'odr_id');
    }

}