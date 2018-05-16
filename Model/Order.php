<?php 

namespace Atharva\OrderMerge\Model;

use Magento\Framework\Model\AbstractModel;

class Order extends AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'atharva_ordermerge';

	protected $_cacheTag = 'atharva_ordermerge';

    protected $_eventPrefix = 'atharva_ordermerge';
    

    protected function _construct() {
        $this->_init('Atharva\OrderMerge\Model\ResourceModel\Order');
    }

    public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
    }
    
    public function getDefaultValues()
	{
		$values = [];
		return $values;
	}
}