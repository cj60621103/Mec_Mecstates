<?php
$installer = $this;
$installer->startSetup();


$installer->addAttribute("customer_address", "area_code",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "Area",
    "input"    => "text",
    "source"   => "",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

	));

        $attribute   = Mage::getSingleton("eav/config")->getAttribute("customer_address", "area_code");

        
$used_in_forms=array();

$used_in_forms[]="adminhtml_customer_address";
$used_in_forms[]="customer_register_address";
$used_in_forms[]="customer_address_edit";
        $attribute->setData("used_in_forms", $used_in_forms)
		->setData("is_used_for_customer_segment", true)
		->setData("is_system", 0)
		->setData("is_user_defined", 1)
		->setData("is_visible", 1)
		->setData("sort_order", 100)
		;
        $attribute->save();
	
	
	
$installer->endSetup();
	 