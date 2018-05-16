<?php

namespace Atharva\OrderMerge\Controller\Order;

use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
        PageFactory $resultPageFactory)
	{
        $this->resultPageFactory = $resultPageFactory;
		return parent::__construct($context);
    }
    
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Custom Order Form'));
        return $resultPage;
    }
}
