<?php
class Mec_Mecstates_Block_Adminhtml_City_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("mecstates_form", array("legend"=>Mage::helper("mecstates")->__("City information")));
				
				
				
				$fieldset->addField(
					'region_code', 'select', array(
												 'label'    => Mage::helper('mecstates')->__('Region'),
												 'name'     => 'region_code',
												 'required' => true,
												 'values'   => Mage::helper('mecstates')->RegionToOptionArray()
											)
				);
				
				$fieldset->addField(
					'city', 'text', array(
												 'label'    => Mage::helper('mecstates')->__('City Name'),
												 'class'    => 'required-entry',
												 'required' => true,
												 'name'     => 'city',
											)
				);
				
				
				if (Mage::getSingleton("adminhtml/session")->getCityData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getCityData());
					Mage::getSingleton("adminhtml/session")->setCityData(null);
				} 
				elseif(Mage::registry("city_data")) {
				    $form->setValues(Mage::registry("city_data")->getData());
				}
				return parent::_prepareForm();
		}
}
