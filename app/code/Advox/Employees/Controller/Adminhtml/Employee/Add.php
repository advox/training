<?php
namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Controller\Adminhtml\Employee;

class Add extends Employee
{
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}