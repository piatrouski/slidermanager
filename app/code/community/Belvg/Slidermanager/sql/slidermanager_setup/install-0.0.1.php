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
 * Create table "belvg_slidermanager_category"
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('slidermanager/category'))
        ->addColumn(
            'category_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            NULL,
            array(
                'identity' => TRUE,
                'unsigned' => TRUE,
                'nullable' => FALSE,
                'primary' => TRUE,
            ),
            'Category Id')
        ->setComment('Slide stores');
$installer->getConnection()->createTable($table);

/**
 * Create table "belvg_slidermanager_link"
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('slidermanager/link'))
        ->addColumn(
            'link_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            NULL,
            array(
                'identity' => TRUE,
                'unsigned' => TRUE,
                'nullable' => FALSE,
                'primary' => TRUE,
            ),
            'Link Id')
        ->setComment('Relation links');
$installer->getConnection()->createTable($table);

/**
 * Create table "belvg_slidermanager_log"
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('slidermanager/log'))
        ->addColumn(
            'log_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            NULL,
            array(
                'identity' => TRUE,
                'unsigned' => TRUE,
                'nullable' => FALSE,
                'primary' => TRUE,
            ),
            'Log Id')
        ->setComment('Clicks log');
$installer->getConnection()->createTable($table);

/**
 * Create table "belvg_slidermanager_slide"
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('slidermanager/slide'))
        ->addColumn(
            'slide_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            NULL,
            array(
                'identity' => TRUE,
                'unsigned' => TRUE,
                'nullable' => FALSE,
                'primary' => TRUE,
            ),
            'Slide Id')
        ->setComment('Slides');
$installer->getConnection()->createTable($table);

/**
 * Create table "belvg_slidermanager_slider"
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('slidermanager/slider'))
        ->addColumn(
            'slider_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            NULL,
            array(
                'identity' => TRUE,
                'unsigned' => TRUE,
                'nullable' => FALSE,
                'primary' => TRUE,
            ),
            'Slider Id')
        ->setComment('Sliders');
$installer->getConnection()->createTable($table);

/**
 * Create table "belvg_slidermanager_store"
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('slidermanager/store'))
        ->addColumn(
            'store_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            NULL,
            array(
                'identity' => TRUE,
                'unsigned' => TRUE,
                'nullable' => FALSE,
                'primary' => TRUE,
            ),
            'Store Id')
        ->setComment('Slide stores');
$installer->getConnection()->createTable($table);

$installer->endSetup();