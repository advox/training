<?php

namespace Advox\Employees\Model;

use Advox\Employees\Api\Data\EmployeeInterface;
use Advox\Employees\Model\ResourceModel\Employee as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel implements EmployeeInterface
{
    protected function _construct(): void
    {
        $this->_init(ResourceModel::class);
    }

    public function getName(): string
    {
        return $this->_getData(EmployeeInterface::NAME);
    }

    public function getPesel(): string
    {
        return $this->_getData(EmployeeInterface::PESEL);
    }

    public function getPosition(): string
    {
        return $this->_getData(EmployeeInterface::POSITION);
    }

    public function setName(string $name): EmployeeInterface
    {
        return $this->setData(EmployeeInterface::NAME, $name);
    }

    public function setPosition(string $position): EmployeeInterface
    {
        return $this->setData(EmployeeInterface::POSITION, $position);
    }

    public function setPesel(string $pesel): EmployeeInterface
    {
        return $this->setData(EmployeeInterface::PESEL, $pesel);
    }

    public function getCreatedAt(): string
    {
        return $this->_getData(EmployeeInterface::CREATED_AT);
    }

    public function getUpdatedAt(): string
    {
        return $this->_getData(EmployeeInterface::UPDATED_AT);
    }
}
