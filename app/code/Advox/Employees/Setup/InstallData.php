<?php

namespace Advox\Employees\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Psr\Log\LoggerInterface;

class InstallData implements InstallDataInterface
{
    /** @var LoggerInterface */
    private $logger;

    /** @var ModuleDataSetupInterface */
    private $setup;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context): void
    {
        try {
            $this->setup = $setup;
            $this->setup->startSetup();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        } finally {
            $this->setup->endSetup();
        }
    }
}
