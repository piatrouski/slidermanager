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

class Belvg_Slidermanager_Block_Adminhtml_Category
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        $this->setForm($form);
        $fieldset = $form->addFieldset('composeslider_form', array(
            'legend' => $this->__('Slider'),
        ));

        $sliders_list = Mage::getModel('slidermanager/slider')
            ->getSlidersList();

        $fieldset->addField('slider_id', 'select', array(
            'label' => $this->__('Slider'),
            'name' => 'slider_id',
            'values' => $sliders_list,
        ));

        $slider_id = $form->getElement('slider_id');
        $slider_id->setValue(self::_getSlider());

        return parent::_prepareForm();
    }

    protected function _getSlider()
    {
        $category_id = (int)Mage::registry('category')->getId();

        if (!$category_id) {
            return 0;
        }

        $category = Mage::getModel('slidermanager/category');
        $category->load($category_id, 'category_uid');

        if ($category->getId()) {
            return $category->getSliderId();
        }

        return 0;
    }
}