<?php

namespace Advox\Employees\Service\adminhtml\Validation;

interface ValidatorInterface
{
    public function validate(array $data): void;
}
