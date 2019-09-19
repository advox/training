<?php

namespace Advox\Employees\Service\adminhtml\Validation;

use Advox\Employees\Api\Data\EmployeeInterface;

class EmployeeValidator implements ValidatorInterface
{
    public function validate(array $data): void
    {
        if (!$data) {
            throw new \RuntimeException(__('Data cannot be empty.'));
        }

        foreach (EmployeeInterface::REQUIRE as $requiredValue) {
            if (!isset($data[$requiredValue])) {
                throw new \InvalidArgumentException(__(sprintf("Argument: %s is missing.", $requiredValue)));
            }
        }
    }
}
