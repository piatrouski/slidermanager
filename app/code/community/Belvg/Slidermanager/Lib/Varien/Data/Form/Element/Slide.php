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

class Belvg_Slidermanager_Lib_Varien_Data_Form_Element_Slide
    extends Varien_Data_Form_Element_Abstract
{
    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setType('label');
    }

    public function getElementHtml()
    {
        $html = '<img id="image-placeholder" src="' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/slidermanager/default.png" />
		<script language="JavaScript" type="text/javascript">
		/*<![CDATA[*/
		belvgSM("#image-placeholder").on("click", function(){
		    if (belvgSM("#' . $this->getLinkedField() . '").val()) {
                belvgSM("#image-placeholder").attr("src", "' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/slidermanager/" + belvgSM("#' . $this->getLinkedField() . '").val());
                belvgSM("#image-placeholder").attr("width", "' . $this->getWidth() . '");
            }
        });
        /*]]>*/
        </script>';

        return $html;
    }

    public function getLabelHtml($idSuffix = '')
    {
        if (!is_null($this->getLabel())) {
            $html = '<label for="'.$this->getHtmlId() . $idSuffix . '" style="'.$this->getLabelStyle().'">'.$this->getLabel()
                . ( $this->getRequired() ? ' <span class="required">*</span>' : '' ).'</label>'."\n";
        }
        else {
            $html = '';
        }
        return $html;
    }
}