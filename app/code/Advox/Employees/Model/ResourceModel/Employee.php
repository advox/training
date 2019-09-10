<?php

namespace Advox\Employees\Model\ResourceModel;

use Advox\Employees\Api\Data\EmployeeInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Employee extends AbstractDb

{
    protected function _construct(): void

    {
        $this->_init(EmployeeInterface::TABLE_NAME, EmployeeInterface::ID);
    }
}
