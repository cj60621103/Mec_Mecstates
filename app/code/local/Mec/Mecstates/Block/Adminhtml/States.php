<?php


class Mec_Mecstates_Block_Adminhtml_States extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_states";
	$this->_blockGroup = "mecstates";
	$this->_headerText = Mage::helper("mecstates")->__("States Manager");
	$this->_addButtonLabel = Mage::helper("mecstates")->__("Add New Item");
	parent::__construct();
	
	}

}