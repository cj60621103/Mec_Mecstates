<?php
class Mec_Mecstates_Model_Mysql4_States extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("mecstates/states", "region_id");
    }
}