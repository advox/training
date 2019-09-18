<?php

namespace Advox\Employees\Block\Adminhtml\Employee\form;

use Advox\Employees\Api\EmployeeRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    /** @var Context */
    protected $context;

    /** @var EmployeeRepositoryInterface */
    private $employeeRepository;

    public function __construct(
        Context $context,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->context = $context;
        $this->employeeRepository = $employeeRepository;
    }

    public function getEmployeeId()
    {
        if (null === $this->context->getRequest()->getParam('id')) {
            return null;
        }
        try {
            return $this->employeeRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
