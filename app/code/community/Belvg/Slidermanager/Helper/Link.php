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

class Belvg_Slidermanager_Helper_Link
    extends Mage_Core_Helper_Abstract
{
    /**
     * Get Url For Product By Sku
     *
     * @param $data
     * @return bool|string
     */
    public function getLinkProduct($data)
    {
        /* @var $product Mage_Catalog_Model_Product */
        $product = Mage::getModel('catalog/product')
            ->loadByAttribute('sku', $data);
        if ($product) {
            return $product->getProductUrl();
        }

        return FALSE;
    }

    /**
     * Get Url For CMS Page
     *
     * @param $data
     * @return string
     */
    public function getLinkCms($data)
    {
        return Mage::getUrl($data);
    }
}