<?php


class Mec_Mecstates_Block_Adminhtml_City extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_city";
	$this->_blockGroup = "mecstates";
	$this->_headerText = Mage::helper("mecstates")->__("City Manager");
	$this->_addButtonLabel = Mage::helper("mecstates")->__("Add New Item");
	parent::__construct();
	
	}

}