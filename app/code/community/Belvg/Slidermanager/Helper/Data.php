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

class Belvg_Slidermanager_Helper_Data
    extends Mage_Core_Helper_Abstract
{
    /**
     * Get extension status
     *
     * @return bool Status
     */
    public function isEnabled()
    {
        return Mage::getStoreConfig('slidermanager/settings/enabled');
    }

    /**
     * Upload image to
     * "media/catalog/slidermanager" folder
     *
     * @return string Image name | empty string
     */
    public function uploadImage()
    {
        if ((isset($_FILES['image']['name']))
            && (!empty($_FILES['image']['name']))
        ) {
            try {
                $uploader = new Varien_File_Uploader('image');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowRenameFiles(FALSE);
                $uploader->setFilesDispersion(FALSE);
                $path = Mage::getBaseDir('media') . DS . 'catalog' . DS . 'slidermanager';
                $uploader->save($path, $_FILES['image']['name']);

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                    ->addError($e->getMessage());
            }

            return $_FILES['image']['name'];
        }

        return '';
    }
}