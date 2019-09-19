<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Model\Employee;

class MassDelete extends MassAction
{
    protected function massAction(Employee $data)
    {
        $this->employeeRepository->delete($data);
        $this->successMessage = __('Deletion Successful.');
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}
