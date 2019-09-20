<?php

namespace Advox\Employees\Block;

use Magento\Framework\View\Element\Template;

class EmployeeLink extends Template
{
    public function getEmployeesIndexUrl(): string
    {
        return $this->getBaseUrl() . "/employees/index/index";
    }
}
