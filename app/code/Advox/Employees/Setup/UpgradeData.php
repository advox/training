<?php
declare(strict_types=1);
namespace Advox\Employees\Setup;

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

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context): void
    {
        try {
            $this->setup = $setup;
            $this->setup->startSetup();

            if (version_compare($context->getVersion(), '1.1.0', '<')) {
                $this->upgrade110();
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        } finally {
            $this->setup->endSetup();
        }
    }
    private function upgrade110(): void {}
}