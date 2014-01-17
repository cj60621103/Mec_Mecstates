<?php
$installer = $this;
$installer->startSetup();

$installer->addAttribute("quote_address", "area_code", array("type"=>"varchar"));
$installer->addAttribute("order_address", "area_code", array("type"=>"varchar"));
$installer->endSetup();
	 