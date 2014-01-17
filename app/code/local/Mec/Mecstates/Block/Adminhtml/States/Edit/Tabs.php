<?php
class Mec_Mecstates_Block_Adminhtml_States_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("states_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("mecstates")->__("Region Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("mecstates")->__("Region Information"),
				"title" => Mage::helper("mecstates")->__("Region Information"),
				"content" => $this->getLayout()->createBlock("mecstates/adminhtml_states_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
