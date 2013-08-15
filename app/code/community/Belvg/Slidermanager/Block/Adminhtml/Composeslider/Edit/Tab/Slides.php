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

class Belvg_Slidermanager_Block_Adminhtml_Composeslider_Edit_Tab_Slides
    extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Set grid params
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('slidermanager_slides_grid');
        $this->setDefaultSort('slide_id');

        $slider_id = (int)$this->getRequest()
            ->getParam('id');

        if ($slider_id) {
            $this->setDefaultFilter(array(
                'in_slider' => 1,
            ));
        }

        $this->setUseAjax(TRUE);

        //$this->setSaveParametersInSession(TRUE);
    }

    /**
     * Prepare collection
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slidermanager/slide')
            ->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Add columns to grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('in_slider', array(
            'header_css_class' => 'a-center',
            'type' => 'checkbox',
            'name' => 'in_slider',
            'values' => $this->_getSelectedSlides(),
            'align' => 'center',
            'index' => 'slide_id'
        ));

        $this->addColumn('_title', array(
            'header' => $this->__('Title'),
            'index' => 'title',
        ));

        $this->addColumn('slide_id', array(
            'header' => $this->__('ID'),
            'sortable' => true,
            'width' => 60,
            'align' => 'center',
            'sortable' => TRUE,
            'index' => 'slide_id',
        ));

        $this->addColumn('image', array(
            'header' => $this->__('Image'),
            'align' => 'left',
            'index' => 'image',
            'sortable' => FALSE,
            'filter' => FALSE,
            'width' => 250,
            'renderer' => new Belvg_Slidermanager_Block_Adminhtml_Renderer_Renderer_Slide(),
        ));

        $this->addColumn('link', array(
            'header' => $this->__('Link'),
            'align' => 'center',
            'index' => 'link',
            'sortable' => FALSE,
            'filter' => FALSE,
            'renderer' => new Belvg_Slidermanager_Block_Adminhtml_Renderer_Renderer_Link(),
        ));

        $this->addColumn('from', array(
            'header' => $this->__('From'),
            'align' => 'center',
            'index' => 'from',
            'width' => '120px',
            'type' => 'date',
        ));

        $this->addColumn('to', array(
            'header' => $this->__('To'),
            'align' => 'center',
            'index' => 'to',
            'width' => '120px',
            'type' => 'date',
        ));

        $this->addColumn('status', array(
            'header' => $this->__('Status'),
            'align' => 'center',
            'index' => 'status',
            'sortable' => FALSE,
            'filter' => FALSE,
            'renderer' => new Belvg_Slidermanager_Block_Adminhtml_Renderer_Renderer_Status(),
        ));

        $this->addColumn('position', array(
            'header' => $this->__('Position'),
            'name' => 'position',
            'width' => 60,
            'type' => 'number',
            'validate_class' => 'validate-number',
            'index' => 'position',
            'editable' => true,
            'edit_only' => true
        ));

        return parent::_prepareColumns();
    }

    /**
     * Rerieve grid URL
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/addslidesGrid', array('_current'=>TRUE));
    }

    /**
     * Get slides for current slider
     *
     * @return array
     */
    public function getSelectedSlides()
    {
        $slides = array();
        $slider_id = (int)$this->getRequest()
            ->getParam('id');

        if (!$slider_id) {
            return $slides;
        }

        $links = Mage::getModel('slidermanager/link')
            ->getCollection()
                ->addFieldToFilter('slider_id', $slider_id);

        foreach ($links as $link) {
            $slides[$link['slide_id']] = array(
                'position' => $link['slide_position'],
            );
        }

        return $slides;
    }

    public function getRowUrl($row)
    {
        return FALSE;
    }

    /**
     * Used in grid to return selected customers values.
     *
     * @return array
     */
    protected function _getSelectedSlides()
    {
        $slides = array_keys($this->getSelectedSlides());

        return $slides;
    }

    /**
     * Add filter
     *
     * @param object $column
     * @return
     */
    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in slide flag
        if ($column->getId() == 'in_slider') {
            $slides_ids = $this->_getSelectedSlides();
            if (empty($slides_ids)) {
                $slides_ids = array(0);
            }

            if ($column->getFilter()->getValue()) {
                $this->getCollection()
                    ->addFieldToFilter('slide_id', array(
                    'in' => $slides_ids
                ));
            } else {
                if($slides_ids) {
                    $this->getCollection()
                        ->addFieldToFilter('slide_id', array(
                        'nin' => $slides_ids
                    ));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }

        return $this;
    }
}