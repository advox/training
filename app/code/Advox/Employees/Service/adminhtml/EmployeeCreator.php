<?php
declare(strict_types=1);

namespace Advox\Employees\Service\adminhtml;

use Advox\Employees\Api\Data\EmployeeInterface;
use Advox\Employees\Api\Data\EmployeeInterfaceFactory;
use Advox\Employees\Api\EmployeeCreatorInterface;
use Advox\Employees\Api\EmployeeRepositoryInterface;
use Advox\Employees\Service\adminhtml\Validation\EmployeeValidator;
use Magento\Framework\ObjectManagerInterface;

class EmployeeCreator implements EmployeeCreatorInterface
{
    /** @var EmployeeRepositoryInterface */
    private $employeeRepository;

    /** @var EmployeeInterfaceFactory */
    private $employeeFactory;

    /** @var EmployeeValidator */
    private $employeeValidator;

    public function __construct(
        EmployeeValidator $employeeValidator,
        EmployeeInterfaceFactory $employeeFactory,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->employeeFactory = $employeeFactory;
        $this->employeeValidator = $employeeValidator;
    }

    public function create(array $data): EmployeeInterface
    {
        $id = (int)$data['id'] ?? null;

        if ($id) {
            $model = $this->employeeRepository->getById($id);
        } else {
            unset($data['id']);
            /** @var EmployeeInterface $model */
            $model = $this->employeeFactory->create();
        }

        $model->setData($data);
        $this->employeeValidator->validate($data);
        return $this->employeeRepository->save($model);
    }
}
