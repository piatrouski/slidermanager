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

class Belvg_Slidermanager_Block_Adminhtml_Manageslides_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('manageslidesGrid');
        $this->setDefaultSort('slide_id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(TRUE);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slidermanager/slide')
            ->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('slide_id', array(
            'header' => $this->__('ID'),
            'align' => 'center',
            'index' => 'slide_id',
            'width' => '50px',
        ));

        $this->addColumn('title', array(
            'header' => $this->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));

        $this->addColumn('image', array(
            'header' => $this->__('Image'),
            'align' => 'center',
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

        $this->addColumn('description', array(
            'header' => $this->__('Description'),
            'align' => 'left',
            'index' => 'description',
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

        $statuses = array(
            $this->__('Disable'),
            $this->__('Enable'),
        );

        $this->addColumn('status', array(
            'header' => $this->__('Status'),
            'align' => 'center',
            'index' => 'status',
            'type' => 'options',
            'filter_condition_callback' => array($this, '_filterStatus'),
            'options' => $statuses,
            'renderer' => new Belvg_Slidermanager_Block_Adminhtml_Renderer_Renderer_Status(),
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/editslide', array('id' => $row->getId()));
    }

    protected function _filterStatus($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return FALSE;
        } else {
            $this->getCollection()
                ->addFieldToFilter('status', $value);
        }
    }
}