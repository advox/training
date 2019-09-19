<?php

namespace Advox\Employees\Controller\Adminhtml;

use Advox\Employees\Api\EmployeeCreatorInterface;
use Advox\Employees\Api\EmployeeRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\View\Result\PageFactory;

abstract class Employee extends Action
{
    public const ADMIN_RESOURCE = 'Advox_Employees::advox_employee_listing';

    /** @var EmployeeRepositoryInterface */
    protected $employeeRepository;

    /** @var PageFactory */
    protected $resultPageFactory;

    /** @var ForwardFactory */
    protected $resultForwardFactory;

    /** @var EmployeeCreatorInterface */
    protected $employeeCreator;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Context $context,
        EmployeeCreatorInterface $employeeCreator
    ) {
        $this->employeeRepository   = $employeeRepository;
        $this->resultPageFactory    = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->employeeCreator = $employeeCreator;

        parent::__construct($context);
    }

    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
