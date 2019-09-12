<?php

namespace Advox\Employees\Model;

use Advox\Employees\Api\Data\EmployeeInterface;
use Advox\Employees\Api\Data\EmployeeInterfaceFactory;
use Advox\Employees\Api\Data\EmployeeSearchResultsInterfaceFactory;
use Advox\Employees\Api\EmployeeRepositoryInterface;
use Advox\Employees\Model\ResourceModel\Employee as EmployeeResourceModel;
use Advox\Employees\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\NoSuchEntityException;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /** @var EmployeeResourceModel */
    private $employeeResourceModel;

    /** @var EmployeeInterfaceFactory */
    private $employeeInterfaceFactory;

    /** @var CollectionFactory */
    private $collectionFactory;

    /** @var CollectionProcessor */
    private $collectionProcessor;

    /** @var EmployeeSearchResultsInterfaceFactory */
    private $employeeSearchResultsFactory;

    public function __construct(
        EmployeeResourceModel $employeeResourceModel,
        EmployeeInterfaceFactory $employee,
        CollectionFactory $collectionFactory,
        CollectionProcessor $collectionProcessor,
        EmployeeSearchResultsInterfaceFactory $employeeSearchResults
    ) {
        $this->employeeResourceModel = $employeeResourceModel;
        $this->employeeInterfaceFactory = $employee;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->employeeSearchResultsFactory = $employeeSearchResults;
    }

    public function save(EmployeeInterface $employee): EmployeeInterface
    {
        try {
            $this->employeeResourceModel->save($employee);
        } catch (\Exception $e) {
            throw new \Exception(__('An error occurred while saving Employee.'));
        }
        return $this->getById($employee->getId());
    }

    public function delete(EmployeeInterface $employee): bool
    {
        try {
            $this->employeeResourceModel->delete($employee);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\StateException(
                __('The "%1" product couldn\'t be removed.'),
                $e
            );
        }
        return true;
    }

    public function getById(int $employeeId): EmployeeInterface
    {
        $employee = $this->employeeInterfaceFactory->create();
        $employee->load($employeeId);
        if (!$employee->getId()) {
            throw new NoSuchEntityException(
                __("The employee that was requested doesn't exist. Verify the employee and try again.")
            );
        }
        return $employee;
    }

    public function deleteById(int $employeeId): bool
    {
        $employee = $this->getById($employeeId);
        return $this->delete($employee);
    }

    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults
    {
        /** @var CollectionFactory $collection */
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);
        $collection->load();

        /** @var EmployeeSearchResultsInterfaceFactory $searchResult */
        $searchResult = $this->employeeSearchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }
}
