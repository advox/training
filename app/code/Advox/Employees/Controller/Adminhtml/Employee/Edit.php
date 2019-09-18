<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Controller\Adminhtml\Employee as EmployeeController;
use Advox\Employees\Model\Employee;

class Edit extends EmployeeController
{
    public function execute()
    {
        $employeeId = $this->getRequest()->getParam('id');

        if ($employeeId) {
            $model = $this->employeeCreator->create(['id' => (int)$this->getRequest()->getParam('id')]);

            if (!$model->getName()) {
                $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Advox_Employees::employee_listing')
            ->addBreadcrumb(__('Data'), __('Data'))
            ->addBreadcrumb(__('Manage Data'), __('Manage Data'));
        if ($employeeId === null) {
            $resultPage->addBreadcrumb(__('New Data'), __('New Data'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Data'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Data'), __('Edit Data'));
            $resultPage->getConfig()->getTitle()->prepend(
                $model->getName()
            );
        }

        return $resultPage;
    }
}
