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

class Belvg_Slidermanager_Block_Adminhtml_Manageslides_Edit_Tab_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        $this->setForm($form);
        $fieldset = $form->addFieldset('manageslides_form', array(
            'legend' => $this->__('Slide Information')
        ));

        $fieldset->addField('title', 'text', array(
            'label' => $this->__('Title'),
            'note' => 'bla-bla',
            'required' => TRUE,
            'name' => 'title',
            'style' => 'width:450px;',
        ));

        $fieldset->addField('image', 'file', array(
            'label' => $this->__('Image'),
            'required' => FALSE,
            'name' => 'image',
            'style' => 'width:450px;',
        ));

        $fieldset->addType(
            'slide',
            'Belvg_Slidermanager_Lib_Varien_Data_Form_Element_Slide'
        );
        $fieldset->addField('slide-image', 'slide', array(
            'required' => FALSE,
            'name' => 'slide-image',
            'width' => '450px',
            'linked_field' => 'image-hidden',
        ));

        $fieldset->addField('image-hidden', 'hidden', array(
            'required' => FALSE,
            'name' => 'image-hidden',
        ));

        $link_types = array(
            'link_none' => $this->__('None'),
            'link_product' => $this->__('Product SKU'),
            'link_cms' => $this->__('CMS Pages'),
            'link_custom' => $this->__('Custom Link'),
        );

        $link_select = $fieldset->addField('link', 'select', array(
            'label' => $this->__('Link type'),
            'required' => FALSE,
            'name' => 'link',
            'style' => 'width:450px;',
            'values' => $link_types,
        ));

        $link_none_type = $fieldset->addField('link_none', 'hidden', array(
            'required' => FALSE,
            'name' => 'link_none',
        ));

        $link_product_type = $fieldset->addField('link_product', 'text', array(
            'label' => $this->__('Product SKU'),
            'note' => 'Link to Product Page',
            'name' => 'link_product',
            'style' => 'width:450px;',
        ));

        $cms_pages_collection = Mage::getModel('cms/page')->getCollection();
        $cms_pages_collection->addFieldToFilter('is_active', 1);

        $link_cms_type = $fieldset->addField('link_cms', 'select', array(
            'label' => $this->__('CMS Pages'),
            'note' => 'Link to CMS Page',
            'name' => 'link_cms',
            'style' => 'width:450px;',
            'values' => $cms_pages_collection->toOptionArray(),
        ));

        $link_custom_type = $fieldset->addField('link_custom', 'text', array(
            'label' => $this->__('Custom Link'),
            'note' => 'bla-bla',
            'name' => 'link_custom',
            'style' => 'width:450px;',
        ));

        $stores_collection = Mage::getModel('core/store')->getCollection();
        $stores_collection->addFieldToFilter('is_active', array(
                'notnull' => TRUE,
            )
        );

        $store_id = $fieldset->addField('stores', 'multiselect', array(
            'label' => $this->__('Stores'),
            'note' => 'bla-bla',
            'required' => TRUE,
            'name' => 'stores',
            'style' => 'width:450px;',
            'values' => $stores_collection->toOptionArray(),
        ));

        $fieldset->addField('description', 'textarea', array(
            'label' => $this->__('Description'),
            'required' => FALSE,
            'name' => 'description',
            'style' => 'width:450px;',
        ));

        $dateFormatIso = Mage::app()->getLocale()
            ->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

        $fieldset->addField('from', 'date', array(
            'label' => $this->__('From'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'required' => FALSE,
            'name' => 'from',
            'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
            'format' => $dateFormatIso,
        ));

        $fieldset->addField('to', 'date', array(
            'label' => $this->__('To'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'required' => FALSE,
            'name' => 'to',
            'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
            'format' => $dateFormatIso,
        ));

        $statuses = array($this->__('Disable'), $this->__('Enable'));
        $fieldset->addField('status', 'select', array(
            'label' => $this->__('Status'),
            'note' => 'bla-bla',
            'required' => FALSE,
            'name' => 'status',
            'values' => $statuses,
        ));

        if (Mage::getSingleton('adminhtml/session')->getSlideData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSlideData());

            Mage::log(
                Mage::getSingleton('adminhtml/session')->getSlideData(),
                NULL,
                'log.log'
            );

            Mage::getSingleton('adminhtml/session')->unsSlideData();
        } elseif (Mage::registry('slide_data')) {
            $form->setValues(Mage::registry('slide_data')->getData());

            // Set values to stores
            $slide_id = Mage::registry('slide_data')->getSlideId();
            $stores = $form->getElement('stores');
            $stores->setValue(self::getValuesStores($slide_id));

            // Set value to image-hidden
            $image_hidden = $form->getElement('image-hidden');
            $image_hidden->setValue(Mage::registry('slide_data')->getImage());

            $slide_image = $form->getElement('slide-image');
            $slide_image->setValue(Mage::registry('slide_data')->getImage());
        }

        $this->setChild(
            'form_after',
            $this->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
                ->addFieldMap($link_select->getHtmlId(), $link_select->getName())
                ->addFieldMap($link_none_type->getHtmlId(), $link_none_type->getName())
                ->addFieldMap($link_cms_type->getHtmlId(), $link_cms_type->getName())
                ->addFieldMap($link_product_type->getHtmlId(), $link_product_type->getName())
                ->addFieldMap($link_custom_type->getHtmlId(), $link_custom_type->getName())
                ->addFieldDependence($link_none_type->getName(), $link_select->getName(), 'link_none')
                ->addFieldDependence($link_product_type->getName(), $link_select->getName(), 'link_product')
                ->addFieldDependence($link_cms_type->getName(), $link_select->getName(), 'link_cms')
                ->addFieldDependence($link_custom_type->getName(), $link_select->getName(), 'link_custom')
        );

        return parent::_prepareForm();
    }

    /**
     * Get values for stores
     *
     * @param $slide_id
     * @return string
     */
    public function getValuesStores($slide_id)
    {
        $collection = Mage::getModel('slidermanager/store')
            ->getCollection()
                ->addFieldToFilter('slide_id', $slide_id);

        $return = array();
        foreach ($collection as $item) {
            $return[] = $item->getStoreUid();
        }

        return implode(',', $return);
    }
}