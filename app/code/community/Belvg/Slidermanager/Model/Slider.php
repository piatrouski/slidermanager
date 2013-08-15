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

class Belvg_Slidermanager_Model_Slider
    extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('slidermanager/slider');
    }

    public function saveSlider($request)
    {
        $post_data = $request->getPost();
        Mage::log($post_data, NULL, 'slider_data.log');
        $post_data?
        try {
            $slider = Mage::getModel('slidermanager/slider');
            $slider->setId($request->getParam('id'));
            $slider->setTitle($post_data['title']);
            $slider->save();

            $result = Mage::getModel('slidermanager/link')
                ->addLink($slider->getId(), $request);

            if (!$result) {
                return FALSE;
            }
        } catch (Exception $e) {
            Mage::log(
                $e->getMessage(),
                NULL,
                'Belvg_Slidermanager_Model_Slider__saveSlider.log'
            );

            return FALSE;
        }

        return TRUE;
    }

    public function getSlidersList()
    {
        $collection = Mage::getModel('slidermanager/slider')
            ->getCollection();

        $result = array();
        $result[] = array(
            'label' => Mage::helper('slidermanager')->__('None'),
            'value' => 0,
        );

        foreach ($collection as $item) {
            $result[] = array(
                'label' => Mage::helper('core')->escapeHtml($item->getTitle()),
                'value' => $item->getId(),
            );
        }

        return $result;
    }
}