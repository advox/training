<?php

namespace Advox\Employees\Model;

use Advox\Employees\Api\Data\EmployeeInterface;
use Advox\Employees\Api\Data\EmployeeInterfaceFactory;
use Advox\Employees\Api\Data\EmployeeSearchResultsInterfaceFactory;
use Advox\Employees\Api\EmployeeRepositoryInterface;
use Advox\Employees\Model\ResourceModel\Employee as EmployeeResourceModel;
use Advox\Employees\Model\ResourceModel\Employee\CollectionFactory;
use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\NoSuchEntityException;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /** @var CollectionProcessor */
    private $collectionProcessor;

    /** @var CollectionFactory */
    private $collectionFactory;

    /** @var EmployeeInterfaceFactory */
    private $employeeInterfaceFactory;

    /** @var EmployeeResourceModel */
    private $employeeResourceModel;

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

    /**
     * @param EmployeeInterface $employee
     *
     * @return EmployeeInterface
     * @throws NoSuchEntityException
     */
    public function save(EmployeeInterface $employee): EmployeeInterface
    {
        try {
            $this->employeeResourceModel->save($employee);
        } catch (Exception $e) {
            throw new Exception(__('An error occurred while saving Employee.'));
        }

        return $this->getById($employee->getId());
    }

    /**
     * @param EmployeeInterface $employee
     *
     * @return bool
     * @throws Exception
     */
    public function delete(EmployeeInterface $employee): bool
    {
        try {
            $this->employeeResourceModel->delete($employee);
        } catch (Exception $e) {
            throw new Exception(__('An error occurred while deleting Employee.'));
        }

        return true;
    }

    /**
     * @param int $employeeId
     *
     * @return EmployeeInterface
     * @throws NoSuchEntityException
     */
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
     * @param int $employeeId
     *
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteById(int $employeeId): bool
    {
        /** @var EmployeeInterface $employee */
        $employee = $this->getById($employeeId);
        
        return $this->delete($employee);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return SearchResults
     */
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
