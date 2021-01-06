<?php

namespace AHT\AddAttributeOrder\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.2') < 0) {
        $setup->getConnection()->addColumn(
            $setup->getTable('quote'),
            'order_by',
            [
                'type' => 'text',
                'nullable' => true,
                'comment' => 'Order By',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            'order_by',
            [
                'type' => 'text',
                'nullable' => true,
                'comment' => 'Order By',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            'order_by',
            [
                'type' => 'text',
                'nullable' => true,
                'comment' => 'Order By',
            ]
        );
        }
        $setup->endSetup();
    }
}
