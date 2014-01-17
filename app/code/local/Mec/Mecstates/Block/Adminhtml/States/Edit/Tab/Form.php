<?php
class Mec_Mecstates_Block_Adminhtml_States_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$countries = Mage::getSingleton('directory/country')->getCollection()->loadData()->toOptionArray(false);
				$id = $this->getRequest()->getParam('id');
				
				$fieldset = $form->addFieldset("mecstates_form", array("legend"=>Mage::helper("mecstates")->__("Region information")));
				$fieldset->addField(
					'country_id', 'select', array(
												 'label'    => Mage::helper('mecstates')->__('Country'),
												 'name'     => 'country_id',
												 'required' => true,
												 'values'   => $countries
											)
				);
				
				if($id != ""){
					$fieldset->addField(
						'code', 'text', array(
											 'label'    => Mage::helper('mecstates')->__('Code'),
											 'class'    => 'required-entry',
											 'required' => true,
											 'name'     => 'code',
											 'readonly' => true,
										)
					);
				
				
				}else{
					$fieldset->addField(
						'code', 'text', array(
											 'label'    => Mage::helper('mecstates')->__('Code'),
											 'class'    => 'required-entry',
											 'required' => true,
											 'name'     => 'code',
										)
					);
					
				}
				
				
				 $fieldset->addField(
					'default_name', 'text', array(
												 'label'    => Mage::helper('mecstates')->__('Default Name'),
												 'class'    => 'required-entry',
												 'required' => true,
												 'name'     => 'default_name',
											)
				);
				
				
				
				
				
				
				if (Mage::getSingleton("adminhtml/session")->getStatesData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getStatesData());
					Mage::getSingleton("adminhtml/session")->setStatesData(null);
				} 
				elseif(Mage::registry("states_data")) {
				    $form->setValues(Mage::registry("states_data")->getData());
				}
				return parent::_prepareForm();
		}
}
