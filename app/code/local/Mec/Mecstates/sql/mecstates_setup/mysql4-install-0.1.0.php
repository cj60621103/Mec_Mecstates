<?php

$installer = $this;
$installer->startSetup();


$installer->run("
DROP TABLE IF EXISTS {$this->getTable('mec_directory_country_region_city')};
CREATE TABLE {$this->getTable('mec_directory_country_region_city')} (
  `id` int(11) NOT NULL AUTO_INCREMENT,
 `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `region_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


$installer->run("
DROP TABLE IF EXISTS {$this->getTable('mec_directory_country_region_city_area')};
CREATE TABLE {$this->getTable('mec_directory_country_region_city_area')} (
  `id` int(11) NOT NULL AUTO_INCREMENT,
 `city_id` int(128) NOT NULL,
 `district` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");



set_time_limit(0);
$fp = fopen( dirname(__FILE__) . '/city.txt', 'r');
$_values = '';
$i =0;
while ($row = fgets($fp)) {
    if($i++==0){
        $_values = trim($row);
    } else {
        $_values = $_values . ", " . trim($row);
    }

}

$installer->run("INSERT INTO {$this->getTable('mec_directory_country_region_city')} (id, city, region_code) VALUES ". $_values . ";");
fclose($fp);




$fp_area = fopen( dirname(__FILE__) . '/area.txt', 'r');
$area_values = '';
$area_i =0;
while ($area_row = fgets($fp_area)) {
    if($area_i++==0){
        $area_values = trim($area_row);
    } else {
        $area_values = $area_values . ", " . trim($area_row);
    }

}
$installer->run("INSERT INTO {$this->getTable('mec_directory_country_region_city_area')} (city_id, district) VALUES ". $area_values . ";");
fclose($fp_area);


$fp_region = fopen( dirname(__FILE__) . '/region.txt', 'r');
$region_values = '';
$region_i =0;
while ($region_row = fgets($fp_region)) {
    if($region_i++==0){
        $region_values = trim($region_row);
    } else {
        $region_values = $region_values . ", " . trim($region_row);
    }

}
$installer->run("INSERT INTO {$this->getTable('directory_country_region')} (country_id, code, default_name) VALUES ". $region_values . ";");
fclose($fp_region);
$installer->endSetup();