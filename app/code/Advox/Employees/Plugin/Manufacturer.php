<?php

namespace Advox\Employees\Plugin;

use Advox\Employees\Api\ConfigurationReaderInterface;
use Magento\Catalog\Api\Data\ProductInterface;

class Manufacturer
{
    /** @var ConfigurationReaderInterface */
    private $configurationReader;

    public function __construct(ConfigurationReaderInterface $configurationReader)
    {
        $this->configurationReader = $configurationReader;
    }

    public function afterGetName(ProductInterface $subject, $name)
    {
        $manufacturer = $subject->getManufacturer();

        if (true === $this->configurationReader->getManufacturerVisibility() && null !== $manufacturer) {
            $name = $manufacturer . ' ' . $name;
        }

        return $name;
    }
}
