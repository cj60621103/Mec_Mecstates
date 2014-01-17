<?php
class Mec_Mecstates_Model_Mysql4_City extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("mecstates/city", "id");
    }
}