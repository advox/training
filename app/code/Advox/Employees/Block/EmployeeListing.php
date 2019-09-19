<?php

namespace Advox\Employees\Block;

use Advox\Employees\Model\EmployeeRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class EmployeeListing extends Template
{
    private $employeeRepository;

    private $criteriaBuilder;

    public function __construct(
    Context $context,
    EmployeeRepository $employeeRepository,
    SearchCriteriaBuilder $criteriaBuilder

    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
        $this->criteriaBuilder = $criteriaBuilder;
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getListEmployees()
    {
        return $this->employeeRepository->getList($this->criteriaBuilder->create())->getItems();
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Employee Listing'));

        return $this;
    }
}
