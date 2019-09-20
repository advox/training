<?php
declare(strict_types=1);
namespace Advox\Employees\Setup;

use Advox\Employees\Api\Data\EmployeeAttributesInterface;
use Exception;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Psr\Log\LoggerInterface;

class UpgradeData implements UpgradeDataInterface
{
    /** @var LoggerInterface */
    private $logger;

    /** @var ModuleDataSetupInterface */
    private $setup;

    /** @var EavSetupFactory */
    private $eavSetupFactory;

    /** @var EavSetup */
    private $eavSetup;

    public function __construct(
        LoggerInterface $logger,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->logger = $logger;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context): void
    {
        try {
            $this->setup = $setup;
            $this->setup->startSetup();
            $this->eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            if (version_compare($context->getVersion(), '1.1.0', '<')) {
                $this->upgrade110();
            }

            if (version_compare($context->getVersion(), '1.2.0', '<')) {
                $this->upgrade120();
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        } finally {
            $this->setup->endSetup();
        }
    }
    private function upgrade110(): void
    {
    }

    private function upgrade120(): void
    {
        $attributeCode = EmployeeAttributesInterface::MANUFACTURER_ATTRIBUTE_CODE;
        $attributeId = $this->eavSetup->getAttributeId(Product::ENTITY, $attributeCode);

        if (false !== $attributeId) {
            return;
        }

        $this->eavSetup->addAttribute(
            Product::ENTITY,
            $attributeCode,
            [
                'group' => 'General',
                'type' => 'text',
                'backend' => '',
                'frontend' => '',
                'label' => EmployeeAttributesInterface::MANUFACTURER_ATTRIBUTE_LABEL,
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => ''
            ]
        );
    }
}
