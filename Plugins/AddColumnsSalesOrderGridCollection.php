<?php 
namespace Atharva\OrderMerge\Plugins;

use Magento\Framework\Message\ManagerInterface as MessageManager;
use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as SalesOrderGridCollection;

class AddColumnsSalesOrderGridCollection
{
    private $messageManager;
    private $collection;

    public function __construct(MessageManager $messageManager,
        SalesOrderGridCollection $collection
    ) {

        $this->messageManager = $messageManager;
        $this->collection = $collection;
    }

    public function aroundGetReport(
        \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject,
        \Closure $proceed,
        $requestName
    ) {
        $result = $proceed($requestName);
        if ($requestName == 'sales_order_grid_data_source') {
            if ($result instanceof $this->collection) {
                $select = $this->collection->getSelect();
                $select->joinLeft(
                    ["customorder" => $this->collection->getTable("atharva_ordermerge")],
                    'main_table.entity_id = customorder.order_id',
                    array('recommend')
                )
                ->distinct();
            }
        }
        return $this->collection;
    }
}
