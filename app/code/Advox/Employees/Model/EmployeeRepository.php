<?php

namespace Advox\Employees\Model;

use Advox\Employees\Api\Data\EmployeeInterface;
use Advox\Employees\Api\Data\EmployeeInterfaceFactory;
use Advox\Employees\Api\Data\EmployeeSearchResultsInterfaceFactory;
use Advox\Employees\Api\EmployeeRepositoryInterface;
use Advox\Employees\Model\ResourceModel\Employee\CollectionFactory;
use Advox\Employees\Model\ResourceModel\Employee as EmployeeResourceModel;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * @var EmployeeResourceModel
     */
    private $employeeResourceModel;
    /**
     * @var EmployeeInterfaceFactory
     */
    private $employeeInterfaceFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var CollectionProcessor
     */
    private $collectionProcessor;
    /**
     * @var EmployeeSearchResultsInterfaceFactory
     */
    private $employeeSearchResultsFactory;


    public function __construct(EmployeeResourceModel $employeeResourceModel,
        EmployeeInterfaceFactory $employee,
        CollectionFactory $collectionFactory,
        CollectionProcessor $collectionProcessor,
        EmployeeSearchResultsInterfaceFactory $employeeSearchResults
    )
    {
        $this->employeeResourceModel = $employeeResourceModel;
        $this->employeeInterfaceFactory = $employee;

        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->employeeSearchResultsFactory = $employeeSearchResults;
    }

    public function save(EmployeeInterface $employee): EmployeeInterface
    {
        return $this->employeeResourceModel->save($employee);
    }

    public function delete(EmployeeInterface $employee): bool
    {
        return $this->employeeResourceModel->delete($employee);
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

    /**
     * @param $employeeId
     *
     * @return bool
     * @throws NoSuchEntityException
     */
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
