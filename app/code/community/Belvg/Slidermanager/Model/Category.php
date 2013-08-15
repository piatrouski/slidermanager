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

class Belvg_Slidermanager_Model_Category
    extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('slidermanager/category');
    }


    public function saveCategory($category_id, $slider_id)
    {
        try {
            $category = Mage::getModel('slidermanager/category')
                ->load($category_id, 'category_uid');

            if ($category->getId()) {
                $category_model = Mage::getModel('slidermanager/category');
                $category_model->setId($category->getId());
                $category_model->setSliderId($slider_id);
                $category_model->setCategoryUid($category_id);
                $category_model->save();
            } else {
                $category_model = Mage::getModel('slidermanager/category');
                $category_model->setId(NULL);
                $category_model->setSliderId($slider_id);
                $category_model->setCategoryUid($category_id);
                $category_model->save();
            }

        } catch (Exception $e) {
            Mage::log(
                $e->getMessage(),
                NULL,
                'Belvg_Slidermanager_Model_Category__saveCategory.log'
            );

            return FALSE;
        }

        return $category_model->getId();
    }

    /**
     * Delete item from Category collection
     *
     * @param $category_id
     * @return bool
     */
    public function deleteCategory($category_id)
    {
        try {
            $category = Mage::getModel('slidermanager/category')
                ->load($category_id, 'category_uid');

            if ($category->getId()) {
                $category_model = Mage::getModel('slidermanager/category');
                $category_model->setId($category->getId())
                    ->delete();

                return TRUE;
            } else {
                Mage::log(
                    'Item doesnt exists!',
                    NULL,
                    'Belvg_Slidermanager_Model_Category__deleteCategory.log'
                );

                return FALSE;
            }
        } catch (Exception $e) {
            Mage::log(
                $e->getMessage(),
                NULL,
                'Belvg_Slidermanager_Model_Category__deleteCategory.log'
            );

            return FALSE;
        }
    }
}