<?php

class Ip_Flashsale_Block_List
    extends Mage_Catalog_Block_Product_Abstract
    implements Mage_Widget_Block_Interface
{

    public function getWidgetId()
    {
        return $this->getData("widget_id");
    }

    public function getProductCount()
    {
        return $this->getData('product_count');
    }

    public function getColumnCount()
    {
        return $this->getData('column_count');
    }

    public function getProductCollection()
    {

        $collection = Mage::getResourceModel('catalog/product_collection');
        $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());

        $todayStartOfDayDate  = Mage::app()->getLocale()->date()
            ->setTime('00:00:00')
            ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $todayEndOfDayDate  = Mage::app()->getLocale()->date()
            ->setTime('23:59:59')
            ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->addAttributeToFilter('special_from_date', array('date' => true, 'to' => $todayEndOfDayDate))
            ->addAttributeToFilter('special_to_date', array('date' => true, 'from' => $todayStartOfDayDate))
            ->addAttributeToFilter(
                array(
                    array('attribute' => 'special_from_date', 'is'=>new Zend_Db_Expr('not null')),
                    array('attribute' => 'special_to_date', 'is'=>new Zend_Db_Expr('not null'))
                )
            )
            ->addAttributeToSort('special_to_date', 'asc')
            ->setPageSize($this->getProductCount())
            ->setCurPage(1);


        return $collection;
    }

    public function timeLeft($timeleft)
    {
        $seconds = $timeleft;

        $days = floor($seconds / 86400);
        $seconds %= 86400;

        $hours = floor($seconds / 3600);
        $seconds %= 3600;

        $minutes = floor($seconds / 60);
        $seconds %= 60;

        if($days){
            return $days.' days '.$hours.' hours';
        } else if($hours){
            return $hours.' hours '.$minutes.' minutes';
        }
        return $minutes.' minutes '.$seconds.' seconds ';

    }

}
