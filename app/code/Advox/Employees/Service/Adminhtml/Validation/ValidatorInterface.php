<?php

namespace Advox\Employees\Service\Adminhtml\Validation;

interface ValidatorInterface
{
    public function validate(array $data): void;
}
