<?php

namespace Advox\Employees\Api\Data;

use Magento\Catalog\Api\Data\ProductInterface;

interface ProductInterfacePlugin
{
    public function afterGetName(ProductInterface $subject, $name): string;
}
