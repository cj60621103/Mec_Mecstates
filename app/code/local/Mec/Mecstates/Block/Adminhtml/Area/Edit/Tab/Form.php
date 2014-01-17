<?php
class Mec_Mecstates_Block_Adminhtml_Area_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("mecstates_form", array("legend"=>Mage::helper("mecstates")->__("Item information")));

				$id = $this->getRequest()->getParam('id');
				/*
				if($id != ""){
					$region_code = Mage::helper('mecstates')->getRegionCode($id);
					$fieldset->addField(
						$region_code, 'select', array(
													 'label'    => Mage::helper('mecstates')->__('Region'),
													 'name'     => 'region_code',
													 'required' => true,
													 'values'   => Mage::helper('mecstates')->RegionToOptionArray()
												)
					);	
				}
				
				*/  //After Change
				
				$fieldset->addField(
					'city_id', 'select', array(
												 'label'    => Mage::helper('mecstates')->__('City'),
												 'name'     => 'city_id',
												 'required' => true,
												 'values'   => Mage::helper('mecstates')->CityToOptionArray()
											)
				);	
				
				$fieldset->addField(
					'district', 'text', array(
												 'label'    => Mage::helper('mecstates')->__('Area Name'),
												 'class'    => 'required-entry',
												 'required' => true,
												 'name'     => 'district',
											)
				);
				
				if (Mage::getSingleton("adminhtml/session")->getAreaData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getAreaData());
					Mage::getSingleton("adminhtml/session")->setAreaData(null);
				} 
				elseif(Mage::registry("area_data")) {
				    $form->setValues(Mage::registry("area_data")->getData());
				}
				return parent::_prepareForm();
		}
}
