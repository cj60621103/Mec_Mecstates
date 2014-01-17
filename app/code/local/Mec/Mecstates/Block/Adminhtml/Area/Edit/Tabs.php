<?php
class Mec_Mecstates_Block_Adminhtml_Area_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("area_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("mecstates")->__("Area Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("mecstates")->__("Area Information"),
				"title" => Mage::helper("mecstates")->__("Area Information"),
				"content" => $this->getLayout()->createBlock("mecstates/adminhtml_area_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
