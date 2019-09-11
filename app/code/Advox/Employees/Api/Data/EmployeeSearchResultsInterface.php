<?php
declare(strict_types=1);
namespace Advox\Employees\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface EmployeeSearchResultsInterface
    extends SearchResultsInterface
{
    /**
     * Get attributes list.
     *
     * @return \Advox\Employees\Api\Data\EmployeeInterface[]
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param \Advox\Employees\Api\Data\EmployeeInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items);
}
