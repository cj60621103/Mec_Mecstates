<?php
	
class Mec_Mecstates_Block_Adminhtml_States_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "region_id";
				$this->_blockGroup = "mecstates";
				$this->_controller = "adminhtml_states";
				$this->_updateButton("save", "label", Mage::helper("mecstates")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("mecstates")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("mecstates")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("states_data") && Mage::registry("states_data")->getId() ){

				    return Mage::helper("mecstates")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("states_data")->getDefaultName()));

				} 
				else{

				     return Mage::helper("mecstates")->__("Add Item");

				}
		}
}