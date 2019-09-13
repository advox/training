<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    public const ADMIN_RESOURCE = 'Advox_Employees::advox_employee_listing';
    /**
     * @var Context
     */
    private $context;
    /**
     * @var PageFactory
     */
    private $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->context = $context;
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        /** @var PageFactory $resultPage */
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Advox_Employees::advox');
        $resultPage->getConfig()->getTitle()->prepend(__('Advox Employeee Listing'));
        return $resultPage;
    }


    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
