<?php

namespace Advox\Employees\Block\Adminhtml\Employee\form;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button atr
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getEmployeeId()) {
            $data = [
                'label' => __('Delete Data'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    /**
     * Get delete URL
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getEmployeeId()]);
    }
}