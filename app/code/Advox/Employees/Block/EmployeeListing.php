<?php

namespace Advox\Employees\Block;

use Advox\Employees\Api\EmployeeRepositoryInterface;
use Advox\Employees\Model\EmployeeRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class EmployeeListing extends Template
{
    /** @var EmployeeRepository */
    private $employeeRepository;

    /** @var SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        EmployeeRepositoryInterface $employeeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getListEmployees(): array
    {
        return $this->employeeRepository->getList($this->searchCriteriaBuilder->create())->getItems();
    }

    protected function _prepareLayout(): self
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Employee Listing'));

        return $this;
    }
}
