<?php
declare(strict_types=1);
namespace Advox\Employees\Setup;

use Advox\Employees\Api\Data\EmployeeAttributesInterface;
use Exception;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
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
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

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

            if (version_compare($context->getVersion(), '1.2.0', '<')) {
                $this->upgrade110();
                $this->upgrade120($setup);
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

    private function upgrade120(ModuleDataSetupInterface $setup): void
    {
        $attributeCode = EmployeeAttributesInterface::MANUFACTURER_ATTRIBUTES_CODE;
        $attributeId = $this->eavSetupFactory->create()->getAttributeId(Product::ENTITY, $attributeCode);


        $eav = $this->eavSetupFactory->create(['setup' => $setup]);
        $eav->addAttribute(
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
