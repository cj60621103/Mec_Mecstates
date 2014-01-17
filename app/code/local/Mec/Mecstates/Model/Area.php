<?php

class Mec_Mecstates_Model_Area extends Mage_Core_Model_Abstract
{
    protected function _construct(){

       $this->_init("mecstates/area");

    }
	
	
	public function loadByField($field, $value)
	{
		$id = $this->getResource()->loadByField($field, $value);
        $ob = $this->load($id);
		return $ob;
	}
	
	
}
	 