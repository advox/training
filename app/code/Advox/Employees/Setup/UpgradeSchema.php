<?php

namespace Advox\Employees\Setup;

use Advox\Employees\Setup\Api\Data\EmployeeInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Psr\Log\LoggerInterface;
use Zend_Db_Exception;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /** @var LoggerInterface */
    private $logger;

    /** @var SchemaSetupInterface */
    private $setup;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        try {
            $this->setup = $setup;
            $this->setup->startSetup();

            if (version_compare($context->getVersion(), '1.1.0', '<')) {
                $this->upgrade110();
            }
        } catch (\Exception | Zend_Db_Exception $e) {
            $this->logger->error($e->getMessage());
        } finally {
            $this->setup->endSetup();
        }
    }

    private function upgrade110(): void
    {
        $connection = $this->getConnection();

        $tableName = $this->setup->getTable(EmployeeInterface::TABLE_NAME);


        /** @var Table $table */
        $table = $connection->newTable($tableName)
            ->addColumn(
                EmployeeInterface::ID,
                Table::TYPE_INTEGER,
                null,

                [

                    'identity' => true,

                    'nullable' => false,

                    'primary' => true,

                    'unsigned' => true,

                ],

                'ID'
            )
            ->addColumn(
                EmployeeInterface::NAME,
                Table::TYPE_TEXT,

                64,

                [

                    'nullable' => false,

                ],

                'Name'
                )
            ->addColumn(
                EmployeeInterface::POSITION,
                Table::TYPE_TEXT,

                64,

                [

                    'nullable' => false,

                ],

                'POSITION'
            )
            ->addColumn(
                EmployeeInterface::PESEL,
                Table::TYPE_TEXT,

                11,

                [

                    'nullable' => false,

                ],

                'POSITION'
            )
            ->addColumn(

                EmployeeInterface::CREATED_AT,

                Table::TYPE_TIMESTAMP,

                null,

                [

                    'default' => TABLE::TIMESTAMP_INIT,

                    'nullable' => false,

                ],

                'Created At'

            )

            ->addColumn(

                EmployeeInterface::UPDATED_AT,

                Table::TYPE_TIMESTAMP,

                null,

                [

                    'default' => Table::TIMESTAMP_INIT_UPDATE,

                    'nullable' => false,

                ],

                'Updated At'

            );

        $connection->createTable($table);
    }

    private function getConnection(): AdapterInterface
    {
        return $this->setup->getConnection();
    }
}