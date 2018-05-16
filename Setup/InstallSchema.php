<?php

namespace Atharva\OrderMerge\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('atharva_ordermerge');
        $tableComment = 'This Table is Custom Admin Module for Save Custom Order Details and join with order tabel .';


        if (!$installer->tableExists('atharva_ordermerge')) {
            $columns = array(
                'odr_id' => array(
                    'type' => Table::TYPE_INTEGER,
                    'size' => null,
                    'options' => array('identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true),
                    'comment' => 'Order Form ID',
                ),
                'order_id' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 32,
                    'options' => array('nullable' => false),
                    'comment' => 'Order ID',
                ),
                'recommend' => array(
                    'type' => Table::TYPE_TEXT,
                    'size' => 50,
                    'options' => array('nullable' => false),
                    'comment' => 'Recommend',
                ),
            );
            $indexes =  array(
                // No index for this table
            );

            $foreignKeys = array(
                // 'order_id' => array(
                //     'ref_table' => 'sales_order',
                //     'ref_column' => 'increment_id',
                //     'on_delete' => 'cascade',
                // ),
            );

            /**
             *  We can use the parameters above to create our table
             */

            // Table creation
            $table = $installer->getConnection()->newTable($tableName);

            // Columns creation
            foreach($columns AS $name => $values){
                $table->addColumn(
                    $name,
                    $values['type'],
                    $values['size'],
                    $values['options'],
                    $values['comment']
                );
            }

            // Indexes creation
            foreach($indexes AS $index){
                $table->addIndex(
                    $installer->getIdxName($tableName, array($index)),
                    array($index)
                );
            }

            // Foreign keys creation
            foreach($foreignKeys AS $column => $foreignKey){
                $table->addForeignKey(
                    $installer->getFkName($tableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                    $column,
                    $foreignKey['ref_table'],
                    $foreignKey['ref_column'],
                    $foreignKey['on_delete']
                );
            }

            // Table comment
            $table->setComment($tableComment);

            // Execute SQL to create the table
            $installer->getConnection()->createTable($table);

            
        }
        // End Setup
        $installer->endSetup();
    }
}