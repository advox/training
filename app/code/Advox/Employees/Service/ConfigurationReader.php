<?php

namespace Advox\Employees\Service;

use Advox\Employees\Api\ConfigurationReaderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigurationReader implements ConfigurationReaderInterface
{
    private const XML_PATH_MANUFACTURER_VISIBILITY = 'catalog/manufacturer/visibility';

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getManufacturerVisibility(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            self::XML_PATH_MANUFACTURER_VISIBILITY
        );
    }
}
