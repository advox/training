<?php

namespace Advox\Employees\Plugin\Magento\Catalog\Model;

use Advox\Employees\Api\ConfigurationReaderInterface;
use Advox\Employees\Api\Data\ProductInterfacePlugin;
use Magento\Catalog\Api\Data\ProductInterface;

class Product implements ProductInterfacePlugin
{
    /** @var ConfigurationReaderInterface */
    private $configurationReader;

    public function __construct(ConfigurationReaderInterface $configurationReader)
    {
        $this->configurationReader = $configurationReader;
    }

    public function afterGetName(ProductInterface $subject, $name): string
    {
        $manufacturer = $subject->getManufacturer();

        if (true === $this->configurationReader->getManufacturerVisibility() && null !== $manufacturer) {
            $name = $manufacturer . ' ' . $name;
        }

        return $name;
    }
}
