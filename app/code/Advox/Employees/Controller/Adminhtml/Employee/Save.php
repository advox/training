<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Api\Data\EmployeeInterfaceFactory;
use Advox\Employees\Controller\Adminhtml\Employee;
use Advox\Employees\Model\EmployeeRepository;
use Advox\Employees\Service\adminhtml\EmployeeCreator;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\Manager;
use Magento\Framework\View\Result\PageFactory;

class Save extends Employee
{
    protected $messageManager;

    protected $dataRepository;

    protected $dataFactory;

    public function __construct(
        EmployeeRepository $dataRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Manager $messageManager,
        EmployeeInterfaceFactory $dataFactory,
        Context $context,
        EmployeeCreator $employeeCreator
    ) {
        $this->messageManager   = $messageManager;
        $this->dataFactory      = $dataFactory;
        $this->dataRepository   = $dataRepository;
        parent::__construct($dataRepository, $resultPageFactory, $resultForwardFactory, $context, $employeeCreator);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $this->employeeCreator->create($data);
            $this->messageManager->addSuccessMessage(__('You saved this data.'));
            $this->_getSession()->setFormData(false);
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
            }
            return $resultRedirect->setPath('*/*/');
        } catch (LocalizedException | \RuntimeException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
