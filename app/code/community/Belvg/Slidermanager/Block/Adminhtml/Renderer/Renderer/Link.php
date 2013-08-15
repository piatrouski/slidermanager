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

class Belvg_Slidermanager_Block_Adminhtml_Renderer_Renderer_Link
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    protected $_row = NULL;

    public function render(Varien_Object $row)
    {
        $this->_row = $row;
        $link = self::getLink();

        return $this->getLayout()
            ->createBlock('slidermanager/adminhtml_renderer_link')
                ->setLink($link)
                    ->_toHtml();
    }

    public function getLink()
    {
        if (!$this->_row) return FALSE;

        switch ($this->_row->getLink()) {
            case Belvg_Slidermanager_Model_Slide::LINK_PRODUCT:
                return Mage::helper('slidermanager/link')
                    ->getLinkProduct($this->_row->getLinkProduct());
                break;

            case Belvg_Slidermanager_Model_Slide::LINK_CMS:
                return Mage::helper('slidermanager/link')
                    ->getLinkCms($this->_row->getLinkCms());
                break;

            case Belvg_Slidermanager_Model_Slide::LINK_CUSTOM:
                return $this->_row->getLinkCustom();
                break;

            default:
                return FALSE;
                break;
        }
    }
}