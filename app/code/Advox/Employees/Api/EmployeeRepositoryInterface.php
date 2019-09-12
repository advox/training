<?php

namespace Advox\Employees\Api;

use Advox\Employees\Api\Data\EmployeeInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;

interface EmployeeRepositoryInterface
{
    public function save(EmployeeInterface $page): EmployeeInterface;

    public function delete(EmployeeInterface $page): bool;

    public function deleteById(int $employeeId): bool;

    public function getById(int $employeeId): EmployeeInterface;

    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;
}
