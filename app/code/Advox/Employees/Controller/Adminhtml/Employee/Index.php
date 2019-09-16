<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Model\EmployeeFactory;
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
    /**
     * @var EmployeeFactory
     */
    private $employeeFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        EmployeeFactory $employeeFactory
    ) {
        parent::__construct($context);
        $this->context = $context;
        $this->pageFactory = $pageFactory;
        $this->employeeFactory = $employeeFactory;
    }

    public function execute()
    {
        /** @var PageFactory $resultPage */
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("Advox Employees Listing"));
        return $resultPage;
    }

    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
