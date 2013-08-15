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

class Belvg_Slidermanager_Adminhtml_SlidermanagerController
    extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        self::checkIsEnabled();
        $this->loadLayout()
            ->_setActiveMenu('promo');

        return $this;
    }

    /**
     * Check for enabled and redirect for
     * disabled module to configuration page
     */
    private function checkIsEnabled()
    {
        if (!Mage::helper('slidermanager')->isEnabled()) {
            Mage::getSingleton('adminhtml/session')
                ->addNotice($this->__('To make Slider Manager work, please, enable it!'));

            $this->_redirect('*/system_config/edit/section/slidermanager/');
        }
    }

    /**
     * Clicks count statistics
     */
    public function statisticsAction()
    {
        $this->_initAction();
        $this->_addContent(
            $this->getLayout()
                ->createBlock('slidermanager/adminhtml_statistics')
        );
        $this->renderLayout();
    }

    /**
     * Slides grid
     */
    public function manageslidesAction()
    {
        $this->_initAction();
        $this->_addContent(
            $this->getLayout()
                ->createBlock('slidermanager/adminhtml_manageslides')
        );
        $this->renderLayout();
    }

    /**
     * New|Edit Slide
     */
    public function editslideAction()
    {
        $slide_id = $this->getRequest()->getParam('id');
        $slide_model = Mage::getModel('slidermanager/slide')
            ->load($slide_id);

        if (($slide_model->getId())
            || ($slide_id == 0)
        ) {
            Mage::register('slide_data', $slide_model);
            $this->_initAction();
            $this->getLayout()->getBlock('head')
                ->setCanLoadExtJs(TRUE);
            $this->getLayout()->getBlock('head')
                ->setCanLoadTinyMce(TRUE);

            $this->_addContent(
                $this->getLayout()->createBlock('slidermanager/adminhtml_manageslides_edit')
            );
            $this->_addLeft(
                $this->getLayout()->createBlock('slidermanager/adminhtml_manageslides_edit_tabs')
            );
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('slidermanager')->__('Slide does not exist'));

            $this->_redirect('*/*/');
        }
    }

    /**
     * Save Slide
     */
    public function saveslideAction()
    {
        if ($this->getRequest()->getPost()) {
            $status = Mage::getModel('slidermanager/slide')
                ->saveSlide($this->getRequest());

            if ($status) {
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('slidermanager')->__('Slide was successfully saved'));
                Mage::getSingleton('adminhtml/session')
                    ->unsSlideData();
                $this->_redirect('*/*/manageslides');
            } else {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('slidermanager')->__('Slide was not saved'));
                Mage::getSingleton('adminhtml/session')
                    ->setSlideData($this->getRequest()->getPost());

                $this->_redirect('*/*/editslide', array(
                        'id' => $this->getRequest()->getParam('id'))
                );
            }
        }

        $this->_redirect('*/*/manageslides');
    }

    /**
     * Delete Slide
     */
    public function deleteslideAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $slide_model = Mage::getModel('slidermanager/slide');
                $slide_model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('slidermanager')->__('Slide was successfully deleted'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                    ->addError($e->getMessage());

                $this->_redirect('*/*/editslide', array(
                        'id' => $this->getRequest()->getParam('id'))
                );
            }
        }

        $this->_redirect('*/*/manageslides');
    }

    /**
     * Sliders grid
     */
    public function composesliderAction()
    {
        $this->_initAction();
        $this->_addContent(
            $this->getLayout()
                ->createBlock('slidermanager/adminhtml_composeslider')
        );
        $this->renderLayout();
    }

    public function editsliderAction()
    {
        $slider_id = $this->getRequest()->getParam('id');
        $slider_model = Mage::getModel('slidermanager/slider')
            ->load($slider_id);

        if (($slider_model->getId())
            || ($slider_id == 0)
        ) {
            Mage::register('slider_data', $slider_model);
            $this->_initAction();
            $this->getLayout()->getBlock('head')
                ->setCanLoadExtJs(TRUE);
            $this->getLayout()->getBlock('head')
                ->setCanLoadTinyMce(TRUE);

            $this->_addContent(
                $this->getLayout()->createBlock('slidermanager/adminhtml_composeslider_edit')
            );
            $this->_addLeft(
                $this->getLayout()->createBlock('slidermanager/adminhtml_composeslider_edit_tabs')
            );
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('slidermanager')->__('Slider does not exist'));

            $this->_redirect('*/*/');
        }
    }

    /**
     * Slides grid
     */
    public function addslidesAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('composeslider-edit-tab-slides');
        $this->renderLayout();
    }

    public function addslidesGridAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('composeslider-edit-tab-slides');
        $this->renderLayout();
    }

    /**
     * Save Slider
     */
    public function savesliderAction()
    {
        if ($this->getRequest()->getPost()) {
            $status = Mage::getModel('slidermanager/slider')
                ->saveSlider($this->getRequest());

            if ($status) {
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('slidermanager')->__('Slider was successfully saved'));
                Mage::getSingleton('adminhtml/session')
                    ->unsSlideData();
                $this->_redirect('*/*/composeslider');
            } else {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('slidermanager')->__('Slide was not saved'));
                Mage::getSingleton('adminhtml/session')
                    ->setSlideData($this->getRequest()->getPost());

                $this->_redirect('*/*/editslide', array(
                        'id' => $this->getRequest()->getParam('id'))
                );
            }
        }

        $this->_redirect('*/*/composeslider');
    }
}