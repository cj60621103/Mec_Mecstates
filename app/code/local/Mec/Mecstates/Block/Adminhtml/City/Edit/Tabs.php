<?php
class Mec_Mecstates_Block_Adminhtml_City_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("city_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("mecstates")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("mecstates")->__("Item Information"),
				"title" => Mage::helper("mecstates")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("mecstates/adminhtml_city_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
