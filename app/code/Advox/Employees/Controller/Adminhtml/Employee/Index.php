<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Controller\Adminhtml\Employee;
use Advox\Employees\Model\EmployeeFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Employee
{
    public function execute()
    {
        /** @var PageFactory $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Advox_Employees::employee_listing');
        $resultPage->getConfig()->getTitle()->prepend(__("Advox Employees Listing"));

        return $resultPage;
    }
}
