<?php
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Ip_Flashsale_Model_Templates
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'flashsale/grid.phtml', 'label'=>'Grid'),
            array('value'=>'flashsale/list.phtml', 'label'=>'List'),
        );
    }

}