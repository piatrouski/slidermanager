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

class Belvg_Slidermanager_Block_Adminhtml_Statistics_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('statisticsGrid');
        $this->setDefaultSort('log_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(TRUE);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slidermanager/log')
            ->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('log_id', array(
            'header' => $this->__('ID'),
            'align' => 'left',
            'index' => 'log_id',
        ));

        $this->addColumn('slide_id', array(
            'header' => $this->__('Slide Id'),
            'align' => 'left',
            'index' => 'slide_id',
        ));

        $this->addColumn('clicks_guests', array(
            'header' => $this->__('Click by guests'),
            'align' => 'left',
            'index' => 'clicks_guests',
        ));

        $this->addColumn('clicks_customers', array(
            'header' => $this->__('Click by customers'),
            'align' => 'left',
            'index' => 'clicks_customers',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return FALSE;
    }
}