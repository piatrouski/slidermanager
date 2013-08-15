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

class Belvg_Slidermanager_Block_Adminhtml_Composeslider
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_composeslider';
        $this->_blockGroup = 'slidermanager';
        $this->setId('slidermanager_composeslider');
        $this->_headerText = $this->__('Compose Slider');
        parent::__construct();

        // Remove Add Button
        $this->_removeButton('add');

        $this->_addButton('slidermanager_composeslider', array(
            'label' => $this->__('Compose Slider'),
            'onclick' => "setLocation('{$this->getUrl('*/slidermanager/editslider')}')",
        ));
    }
}