<?php

namespace Advox\Employees\Setup\Api\Data;

interface EmployeeInterface
{
    public const TABLE_NAME = 'advox_employee';

    public const ID = 'id';

    public const NAME = 'name';

    public const POSITION = 'position';

    public const PESEL = 'pesel';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    public function getId();

    public function setId($id);

    public function getName(): string;

    public function getPosition(): string;

    public function setName(string $name): EmployeeInterface;
}
