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

class Belvg_Slidermanager_Model_Observer_Category
{
    public function addTab(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('slidermanager')->isEnabled()) return FALSE;

        /* @var $tabs Mage_Adminhtml_Block_Catalog_Category_Tabs */
        $tabs = $observer->getEvent()
            ->getTabs();

        $tabs->addTab('slidermanager-tab', array(
            'label' => Mage::helper('slidermanager')->__('Slider Manager'),
            'content' => $tabs->getLayout()->createBlock(
                'slidermanager/adminhtml_category',
                'slidermanager.category.tab'
            )
                ->toHtml(),
        ));
    }

    public function save(Varien_Event_Observer $observer)
    {
        if (!Mage::helper('slidermanager')->isEnabled()) {
            return FALSE;
        }

        $category = $observer->getEvent()
            ->getCategory();
        $post = Mage::app()->getRequest()
            ->getPost();

        if (!isset($post['slider_id'])) {
            return FALSE;
        }

        if ($post['slider_id'] == 0) {
            $result = Mage::getModel('slidermanager/category')
                ->deleteCategory($category->getId());
        } else {
            $result = Mage::getModel('slidermanager/category')
                ->saveCategory($category->getId(), $post['slider_id']);
        }

        return $result;
    }
}