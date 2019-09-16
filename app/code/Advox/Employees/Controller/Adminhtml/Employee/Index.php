<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Model\EmployeeFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    public const ADMIN_RESOURCE = 'Advox_Employees::advox_employee_listing';

    /** @var EmployeeFactory */
    private $employeeFactory;

    /** @var PageFactory */
    private $pageFactory;

    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->employeeFactory = $employeeFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        /** @var PageFactory $resultPage */
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Advox_Employees::employee_listing');
        $resultPage->getConfig()->getTitle()->prepend(__("Advox Employees Listing"));

        return $resultPage;
    }

    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
