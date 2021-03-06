<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Api\EmployeeCreatorInterface;
use Advox\Employees\Api\EmployeeRepositoryInterface;
use Advox\Employees\Controller\Adminhtml\Employee;
use Advox\Employees\Model\Employee as EmployeeModel;
use Advox\Employees\Model\EmployeeRepository;
use Advox\Employees\Model\ResourceModel\Employee\CollectionFactory;
use Advox\Employees\Service\EmployeeService;
use Exception;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;

abstract class MassAction extends Employee
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var string
     */
    protected $successMessage;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * MassAction constructor.
     *
     * @param Filter $filter
     * @param EmployeeRepositoryInterface $employeeRepository
     * @param PageFactory $resultPageFactory
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param ForwardFactory $resultForwardFactory
     * @param $successMessage
     * @param $errorMessage
     */
    public function __construct(
        Filter $filter,
        EmployeeRepositoryInterface $employeeRepository,
        EmployeeCreatorInterface $employeeCreator,
        PageFactory $resultPageFactory,
        Context $context,
        CollectionFactory $collectionFactory,
        ForwardFactory $resultForwardFactory,
        $successMessage,
        $errorMessage
    ) {
        $this->filter               = $filter;
        $this->collectionFactory    = $collectionFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->successMessage       = $successMessage;
        $this->errorMessage         = $errorMessage;
        parent::__construct($employeeRepository, $resultPageFactory, $resultForwardFactory, $context, $employeeCreator);
    }

    abstract protected function massAction(EmployeeModel $data);

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $data) {
                $this->massAction($data);
            }
            $this->messageManager->addSuccessMessage(__($this->successMessage, $collectionSize));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (Exception $e) {
            $this->messageManager->addExceptionMessage($e, __($this->errorMessage));
        }
        $redirectResult = $this->resultRedirectFactory->create();
        $redirectResult->setPath(EmployeeService::URL_PATH_INDEX);
        return $redirectResult;
    }
}
