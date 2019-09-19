<?php

namespace Advox\Employees\Controller\Adminhtml\Employee;

use Advox\Employees\Controller\Adminhtml\Employee;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends Employee
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $employee = $this->employeeRepository->getById(((int)$this->getRequest()->getParam('id')));
            $this->employeeRepository->delete($employee);
            $this->messageManager->addSuccessMessage(__('The data has been deleted.'));
            $resultRedirect->setPath('employees/employee/index');
            return $resultRedirect;
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('The data no longer exists.'));
            return $resultRedirect->setPath('employees/employee/index');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect->setPath('employees/employee/index', ['id' => $dataId]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was a problem deleting the data'));
            return $resultRedirect->setPath('employees/employee/edit', ['id' => $dataId]);
        }
    }
}
