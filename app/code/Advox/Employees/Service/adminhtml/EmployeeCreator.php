<?php
declare(strict_types=1);

namespace Advox\Employees\Service\adminhtml;

use Advox\Employees\Api\Data\EmployeeInterface;
use Advox\Employees\Api\Data\EmployeeInterfaceFactory;
use Advox\Employees\Api\EmployeeCreatorInterface;
use Advox\Employees\Api\EmployeeRepositoryInterface;
use Advox\Employees\Service\adminhtml\Validation\EmployeeValidator;
use Magento\Framework\ObjectManagerInterface;
use Zend\Db\Exception\RuntimeException;

class EmployeeCreator implements EmployeeCreatorInterface
{
    private $objectManager;
    /** @var EmployeeRepositoryInterface */
    private $employeeRepository;
    /** @var EmployeeInterfaceFactory */
    private $employeeFactory;
    /**
     * @var EmployeeValidator
     */
    private $employeeValidator;

    public function __construct(EmployeeValidator $employeeValidator, EmployeeInterfaceFactory $employeeFactory, ObjectManagerInterface $objectManager, EmployeeRepositoryInterface $employeeRepository)
    {
        $this->objectManager = $objectManager;
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
            $this->employeeValidator->validate($data);
            /** @var EmployeeInterface $model */
            $model = $this->employeeFactory->create();
        }

        $model->setData($data);
        return $this->employeeRepository->save($model);
    }
}
