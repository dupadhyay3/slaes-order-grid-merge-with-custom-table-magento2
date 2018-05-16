<?php

namespace Atharva\OrderMerge\Controller\Order;

use Atharva\OrderMerge\Model\OrderFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;


class Post extends \Magento\Framework\App\Action\Action
{
    protected $_orderFactory;
    protected $resultRedirect;

	public function __construct(
        \Magento\Framework\App\Action\Context $context,
        OrderFactory $orderFactory)
	{
        $this->_orderFactory = $orderFactory;
		parent::__construct($context);
    }

    // public function __construct(
    //     \Magento\Framework\App\Action\Context $context,
    //     \Bss\Schema\Model\DataExampleFactory  $dataExample,
    //     \Magento\Framework\Controller\ResultFactory $result){
    //     parent::__construct($context);
    //     $this->_dataExample = $dataExample;
    //     $this->resultRedirect = $result;
    // }

    
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        // $modelCol = $this->_orderFactory->create();
        // echo "<pre>"; print_r($modelCol->getCollection()->getData()); exit;
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('custom/order/index');

        $post = $this->getRequest()->getPostValue();
        if (!$post) {
            $this->messageManager->addError( __('‘We can\’t process your request right now. Sorry, that\’s all we know.’') );
            return $resultRedirect;
        }

        $model = $this->_orderFactory->create();
        $data = $this->getRequest()->getPost();
        // echo "<pre>"; print_r($data);
        // exit;

        // $obj = $this->_objectManager->create("Atharva\OrderMerge\Model\Order");
        // $obj->setData('order_id',$data['orde_id']);
        // $obj->setData('recommend',$data['recommend']);

        $model->addData([
			"order_id" => $data['orde_id'],
			"recommend" => $data['recommend']
            ]);
        $resultSave = $model->save();
        if($resultSave){
            $this->messageManager->addSuccess( __('Insert Record Successfully !') );
            return $resultRedirect;
        }else{
            $this->messageManager->addError( __('‘We can\’t process your request right now. Sorry, that\’s all we know.’') );
            return $resultRedirect;
        }
    }
}
