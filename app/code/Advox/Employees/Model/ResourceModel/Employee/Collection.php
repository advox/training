<?php

namespace Advox\Employees\Model\ResourceModel\Employee;

use Advox\Employees\Api\Data\EmployeeInterface;
use Advox\Employees\Model\Employee as Model;
use Advox\Employees\Model\ResourceModel\Employee as ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /** @var string */
    protected $_idFieldName = EmployeeInterface::ID;

    protected function _construct(): void
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
