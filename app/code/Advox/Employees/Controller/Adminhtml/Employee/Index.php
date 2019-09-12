<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;

class Index extends Action
{
    private const ADMIN_RESOURCE = 'Advox_Employees::advox_employee_listing';

    public function execute(): void
    {
        echo "Hello World";
    }


    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
