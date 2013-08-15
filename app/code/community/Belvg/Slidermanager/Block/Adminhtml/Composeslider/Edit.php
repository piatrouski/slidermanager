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

class Belvg_Slidermanager_Block_Adminhtml_Composeslider_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'slidermanager';
        $this->_controller = 'adminhtml_composeslider';

        // Change Back Button Action
        $this->_updateButton(
            'back',
            'onclick',
            'setLocation(\'' . $this->getUrl('*/slidermanager/composeslider') . '\')'
        );

        // Remove Reset Button
        $this->_removeButton('reset');

        // Rename Delete Button
        $this->_updateButton('delete', 'label', $this->__('Delete Slider'));

        // Change Delete Button Action
        $this->_updateButton(
            'delete',
            'onclick',
            'deleteConfirm(\'' . $this->__('Are you sure you want to do this?') . '\', \'' . $this->getUrl('*/*/deleteslider', array('id' => $this->getRequest()->getParam('id'))) .'\')'
        );

        // Rename Save Button
        $this->_updateButton('save', 'label', $this->__('Save Slider'));
    }

    /**
     * Get Header Text
     *
     * @return string Add Slider|Edit Slider
     */
    public function getHeaderText()
    {
        if ((Mage::registry('slider_data'))
            && (Mage::registry('slider_data')->getId())
        ) {

            return $this->__('Edit Slider «%s»', Mage::registry('slider_data')->getTitle());
        } else {

            return $this->__('Add Slider');
        }
    }
}