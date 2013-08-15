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

class Belvg_Slidermanager_Model_Slide
    extends Mage_Core_Model_Abstract
{
    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;

    const LINK_NONE = 'link_none';
    const LINK_CMS = 'link_cms';
    const LINK_PRODUCT = 'link_product';
    const LINK_CUSTOM = 'link_custom';

    protected function _construct()
    {
        $this->_init('slidermanager/slide');
    }

    public function saveSlide($request)
    {
        $post_data = $request->getPost();
        Mage::log($post_data, NULL, 'slide_data.log');

        try {
            $slide_model = Mage::getModel('slidermanager/slide');

            $name = Mage::helper('slidermanager')->uploadImage();
            if ((empty($name))
                && (!empty($post_data['image-hidden']))
            ) {
                $name = $post_data['image-hidden'];
            }

            $slide_model->setId($request->getParam('id'));
            $slide_model->setTitle($post_data['title']);
            $slide_model->setImage($name);
            $slide_model->setLink($post_data['link']);

            switch ($post_data['link']) {
                case self::LINK_NONE:
                    break;

                case self::LINK_PRODUCT:
                    $slide_model->setLinkProduct($post_data['link_product']);
                    break;

                case self::LINK_CMS:
                    $slide_model->setLinkCms($post_data['link_cms']);
                    break;

                case self::LINK_CUSTOM:
                    $slide_model->setLinkCustom($post_data['link_custom']);
                    break;

                default:
                    Mage::log(
                        'Check this link type: ' . $post_data['link'] . '!',
                        NULL,
                        'Belvg_Slidermanager_Model_Slide__saveSlide.log'
                    );
                    break;
            }

            $slide_model->setDescription($post_data['description']);
            $slide_model->setFrom($post_data['from']);
            $slide_model->setTo($post_data['to']);
            $slide_model->setStatus($post_data['status']);

            $slide_model->save();

            Mage::getModel('slidermanager/store')
                ->linkStores($slide_model->getId(), $post_data['stores']);

            return TRUE;
        } catch (Exception $e) {
            Mage::log(
                $e->getMessage(),
                NULL,
                'Belvg_Slidermanager_Model_Slide__saveSlide.log'
            );

            return FALSE;
        }

        return FALSE;
    }
}