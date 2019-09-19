<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Controller\Adminhtml\Employee;
use Advox\Employees\Service\EmployeeService;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends Employee
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $employeeId = $this->getRequest()->getParam('id');

        try {
            $employee = $this->employeeRepository->getById(($employeeId));
            $this->employeeRepository->delete($employee);
            $this->messageManager->addSuccessMessage(__('The data has been deleted.'));
            $resultRedirect->setPath(EmployeeService::URL_PATH_INDEX);
            return $resultRedirect;
        } catch (NoSuchEntityException | LocalizedException $e) {
            $this->messageManager->addErrorMessage(__('The data no longer exists.'));
            return $resultRedirect->setPath(EmployeeService::URL_PATH_INDEX);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was a problem deleting the data'));
            return $resultRedirect->setPath(EmployeeService::URL_PATH_EDIT, ['id' => $employeeId]);
        }
    }
}
