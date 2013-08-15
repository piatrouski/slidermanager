<?php
/**
 * BelVG LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 *
 * MAGENTO EDITION USAGE NOTICE
 *
 * This package designed for Magento COMMUNITY edition
 * BelVG does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * BelVG does not provide extension support in case of
 * incorrect edition usage.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future.
 *
 * @category   Belvg
 * @package    Belvg_Slidermanager
 * @author     Siaržuk Piatroŭski (siarzuk@piatrouski.com)
 * @copyright  Copyright (c) 2010 - 2012 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();

/**
 * For more information see slidermanager_scheme.png
 * at Slider Manager root folder
 */

/**
 * Category
 */
$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/category'), 'slider_id', array(
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'nullable' => FALSE,
        'unsigned' => TRUE,
        'comment' => 'Slider Id',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/category'), 'category_uid', array(
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'nullable' => FALSE,
        'unsigned' => TRUE,
        'comment' => 'Category Id',
));

/**
 * Link
 */
$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/link'), 'slider_id', array(
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'nullable' => FALSE,
        'unsigned' => TRUE,
        'comment' => 'Slider Id',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/link'), 'slide_id', array(
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'nullable' => FALSE,
        'unsigned' => TRUE,
        'comment' => 'Slide Id',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/link'), 'slide_position', array(
            'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
            'unsigned' => TRUE,
            'nullable' => FALSE,
            'default' => 0,
            'comment' => 'Slide Position',
));

/**
 * Log
 */
$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/log'), 'slide_id', array(
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'nullable' => FALSE,
        'unsigned' => TRUE,
        'comment' => 'Slide Id',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/log'), 'clicks_guests', array(
        'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'unsigned' => TRUE,
        'nullable' => FALSE,
        'default' => 0,
        'comment' => 'Clicks by guests',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/log'), 'clicks_customers', array(
        'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'unsigned' => TRUE,
        'nullable' => FALSE,
        'default' => 0,
        'comment' => 'Clicks by customers',
));

/**
 * Slide
 */
$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'title', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => FALSE,
        'comment' => 'Title',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'image', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => FALSE,
        'comment' => 'Image',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'link', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => FALSE,
        'comment' => 'Type of link',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'link_product', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment' => 'Product SKU',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'link_cms', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment' => 'CMS Page',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'link_custom', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment' => 'External link',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'description', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment' => 'Description',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'from', array(
        'type' => Varien_Db_Ddl_Table::TYPE_DATE,
        'nullable' => TRUE,
        'comment' => 'Slide From Date',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'to', array(
        'type' => Varien_Db_Ddl_Table::TYPE_DATE,
        'nullable' => TRUE,
        'comment' => 'Slide To Date',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slide'), 'status', array(
        'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'unsigned' => TRUE,
        'nullable' => FALSE,
        'default' => 0,
        'comment' => 'Status',
));

/**
 * Slider
 */
$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slider'), 'title', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => FALSE,
        'comment' => 'Title',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/slider'), 'options', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'nullable' => FALSE,
    'comment' => 'Slider options',
));

/**
 * Store
 */
$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/store'), 'slide_id', array(
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'nullable' => FALSE,
        'unsigned' => TRUE,
        'comment' => 'Slide Id',
));

$installer->getConnection()
    ->addColumn($installer->getTable('slidermanager/store'), 'store_uid', array(
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'nullable' => FALSE,
        'unsigned' => TRUE,
        'comment' => 'Store Uid',
));

/**
 * Add foreign key: belvg_slidermanager_category:slider_id > belvg_slidermanager_slider:slider_id
 */
$installer->getConnection()
    ->addForeignKey(
        $installer->getFkName(
            'slidermanager/category',
            'slider_id',
            'slidermanager/slider',
            'slider_id'
        ),
        $installer->getTable('slidermanager/category'),
        'slider_id',
        $installer->getTable('slidermanager/slider'),
        'slider_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_NO_ACTION
);

/**
 * Add foreign key: belvg_slidermanager_link:slider_id > belvg_slidermanager_slider:slider_id
 */
$installer->getConnection()
    ->addForeignKey(
        $installer->getFkName(
            'slidermanager/link',
            'slider_id',
            'slidermanager/slider',
            'slider_id'
        ),
        $installer->getTable('slidermanager/link'),
        'slider_id',
        $installer->getTable('slidermanager/slider'),
        'slider_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_NO_ACTION
);

/**
 * Add foreign key: belvg_slidermanager_store:slide_id > belvg_slidermanager_slide:slide_id
 */
$installer->getConnection()
    ->addForeignKey(
        $installer->getFkName(
            'slidermanager/store',
            'slide_id',
            'slidermanager/slide',
            'slide_id'
        ),
        $installer->getTable('slidermanager/store'),
        'slide_id',
        $installer->getTable('slidermanager/slide'),
        'slide_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_NO_ACTION
);

/**
 * Add foreign key: belvg_slidermanager_log:slide_id > belvg_slidermanager_slide:slide_id
 */
$installer->getConnection()
    ->addForeignKey(
        $installer->getFkName(
            'slidermanager/log',
            'slide_id',
            'slidermanager/slide',
            'slide_id'
        ),
        $installer->getTable('slidermanager/log'),
        'slide_id',
        $installer->getTable('slidermanager/slide'),
        'slide_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_NO_ACTION
);

$installer->endSetup();