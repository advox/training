<?php

namespace Advox\Employees\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class EmployeeLink extends Template
{
    private $employeeHelper;

    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
}
