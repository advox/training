<?php

namespace Advox\Employees\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /** @param PageFactory $pageFactory */
    private $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var PageFactory $resultPage */
        $resultPage = $this->pageFactory->create();

        return $resultPage;
    }
}
