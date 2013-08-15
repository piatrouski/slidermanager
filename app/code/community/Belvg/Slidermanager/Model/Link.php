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

class Belvg_Slidermanager_Model_Link
    extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('slidermanager/link');
    }

    public function addLink($slider_id, $request)
    {
        $post = $request->getPost();

        if (!isset($post['slider']['slide'])) {
            return TRUE;
        }

        // TODO: Check result and make epic fail
        self::removeLinks($slider_id);

        $slides = Mage::helper('adminhtml/js')
            ->decodeGridSerializedInput($post['slider']['slide']);

        foreach ($slides as $key => $value) {
            try {
                $link = Mage::getModel('slidermanager/link');
                $link->setSliderId($slider_id);
                $link->setSlideId($key);

                if (isset($value['position'])) {
                    $link->setSlidePosition(intval($value['position']));
                }

                $link->save();
            } catch (Exception $e) {
                Mage::log(
                    $e->getMessage(),
                    NULL,
                    'Belvg_Slidermanager_Model_Link__addLink.log'
                );

                return FALSE;
            }
        }

        return TRUE;
    }

    public function removeLinks($slider_id)
    {
        $collection = Mage::getModel('slidermanager/link')
            ->getCollection()
                ->addFieldToFilter('slider_id', $slider_id);

        foreach ($collection as $item) {
            try {
                Mage::getModel('slidermanager/link')
                    ->setId($item->getId())
                        ->delete();
            } catch (Exception $e) {
                Mage::log(
                    $e->getMessage(),
                    NULL,
                    'Belvg_Slidermanager_Model_Link__removeLinks.log'
                );

                return FALSE;
            }
        }

        return TRUE;
    }
}