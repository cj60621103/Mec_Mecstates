<?php
class Mec_Mecstates_Helper_Data extends Mage_Core_Helper_Abstract
{

	public function validationSaveData($country_code, $region_code)
	{
		$size = Mage::getModel('mecstates/states')->getCollection()
				->addFieldToFilter('country_id', array('eq' => $country_code))
				->addFieldToFilter('code', array('eq' => $region_code))
				->getSize();
				
		if($size > 0){
			return false;
		}else{
			return true;
		}
	
	
	}
	
	
	public function validationSaveCityData($region_code, $city_name)
	{
		$size = Mage::getModel('mecstates/city')->getCollection()
				->addFieldToFilter('region_code', array('eq' => $region_code))
				->addFieldToFilter('city', array('eq' => $city_name))
				->getSize();
				
		if($size > 0){
			return false;
		}else{
			return true;
		}
	}
	
	
	public function validationSaveAreaData($city_id, $area_name)
	{
		$size = Mage::getModel('mecstates/area')->getCollection()
				->addFieldToFilter('city_id', array('eq' => $city_id))
				->addFieldToFilter('district', array('eq' => $area_name))
				->getSize();
				
		if($size > 0){
			return false;
		}else{
			return true;
		}
	
	}
	
	
	
	
	public function RegionToOptionArray()
	{
		$regions_array = array();
		$china_region = Mage::getModel('mecstates/states')->getCollection()
						->addFieldToFilter('country_id', array('eq' => 'CN'));
						
		foreach($china_region as $_region){
			$regions_array[$_region->getCode()] = $_region->getDefaultName();
		}
		
		return $regions_array;
	}
	
	
	public function CityToOptionArray()
	{
		$citys_array = array();
		$china_citys = Mage::getModel('mecstates/city')->getCollection();
		foreach($china_citys as $_city){
			$citys_array[$_city->getId()] = $_city->getCity();
		}
					   
		return $citys_array;
	}
	
	
	public function getRegionCode($area_id)
	{
		 $resource = Mage::getSingleton('core/resource');
         $read = $resource->getConnection('core_read');
		 $select = $read->select()->from(array('city' => 'mec_directory_country_region_city'))->where('city.id=?', $city_id);
		 $data = $read->fetchAll($select);
		 $region_code = '';
		 foreach($data as $_row){
			$region_code = $_row['region_code'];
		 }
		 
		 return $region_code;
	
	}
	
	

}
	 