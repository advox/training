<?php

declare(strict_types=1);

namespace Advox\Employees\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface EmployeeSearchResultsInterface extends SearchResultsInterface
{
    public function getItems(): EmployeeSearchResultsInterface;

    public function setItems(array $items): EmployeeSearchResultsInterface;
}
