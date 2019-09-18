<?php

namespace Advox\Employees\Controller\Adminhtml;

use Advox\Employees\Api\EmployeeCreatorInterface;
use Advox\Employees\Service\adminhtml\EmployeeCreator;
use Advox\Employees\Api\EmployeeRepositoryInterface;
use Advox\Employees\Model\EmployeeRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\View\Result\PageFactory;

abstract class Employee extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Advox_Employees::advox_employee_listing';

    /**
     * Data repository
     *
     * @var EmployeeRepositoryInterface
     */
    protected $employeeRepository;

    /**
     * Result Page Factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Result Forward Factory
     *
     * @var ForwardFactory
     */
    protected $resultForwardFactory;
    /**
     * @var EmployeeCreatorInterface
     */
    protected $employeeCreator;

    /**
     * Data constructor.
     *
     * @param EmployeeRepositoryInterface $employeeRepository
     * @param PageFactory                 $resultPageFactory
     * @param ForwardFactory              $resultForwardFactory
     * @param Context                     $context
     * @param EmployeeCreatorInterface    $employeeCreator
     */
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
