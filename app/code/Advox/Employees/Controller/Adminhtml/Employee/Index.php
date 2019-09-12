<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;

class Index extends Action
{
    private const ADMIN_RESOURCE = 'Advox_Employees::content';

    public function execute(): void
    {
        echo "Hello World";
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
