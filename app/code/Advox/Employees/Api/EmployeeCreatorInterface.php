<?php
declare(strict_types=1);

namespace Advox\Employees\Api;

use Advox\Employees\Api\Data\EmployeeInterface;

interface EmployeeCreatorInterface
{
    public function create(array $data): EmployeeInterface;
}
