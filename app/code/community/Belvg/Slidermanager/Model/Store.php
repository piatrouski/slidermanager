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

class Belvg_Slidermanager_Model_Store
    extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('slidermanager/store');
    }

    /**
     * Link slide with stores
     *
     * @param $slide_id
     * @param $data
     * @return bool
     */
    public function linkStores($slide_id, $data)
    {
        self::unlinkStores($slide_id);

        if (is_array($data)) {
            foreach ($data as $store) {
                try {
                    $store_model = Mage::getModel('slidermanager/store');
                    $store_model->setId(NULL);
                    $store_model->setSlideId($slide_id);
                    $store_model->setStoreUid($store);
                    $store_model->save();
                } catch (Exception $e) {
                    Mage::log(
                        $e->getMessage(),
                        NULL,
                        'Belvg_Slidermanager_Model_Store__linkStores.log'
                    );

                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    /**
     * Unlink all stores for slide id
     *
     * @param $slide_id
     * @return bool
     */
    public function unlinkStores($slide_id)
    {
        $stores_collection = Mage::getModel('slidermanager/store')
            ->getCollection()
                ->addFieldToFilter('slide_id', $slide_id);

        foreach ($stores_collection as $store) {
            try {
                Mage::getModel('slidermanager/store')
                    ->setId($store->getId())
                        ->delete();
            } catch (Exception $e) {
                Mage::log(
                    $e->getMessage(),
                    NULL,
                    'Belvg_Slidermanager_Model_Store__unlinkStores.log'
                );

                return FALSE;
            }
        }

        return TRUE;
    }
}