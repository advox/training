<?php

namespace Advox\Employees\Ui\Component\Employee\Listing\form;

use Advox\Employees\Service\EmployeeService;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class EmployeeActions extends Column
{
    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }
        foreach ($dataSource['data']['items'] as & $item) {
            $id = $item['id'] ?? null;

            if (!isset($id)) {
                continue;
            }
            $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                EmployeeService::URL_PATH_EDIT,
                                [
                                    'id' => $id
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                EmployeeService::URL_PATH_DELETE,
                                [
                                    'id' => $id
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete "${ $.$data.name }"'),
                                'message' => __('Are you sure you want to delete the Data: "${ $.$data.name }"?')
                            ]
                        ]
                    ];
        }
        return $dataSource;
    }
}
