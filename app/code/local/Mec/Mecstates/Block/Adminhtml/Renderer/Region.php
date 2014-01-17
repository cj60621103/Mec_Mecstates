<?php
class Mec_Mecstates_Block_Adminhtml_Renderer_Region extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action{


	 public function render(Varien_Object $row)
	 {
		 $html = '';
		 
		 $city_id = $row->getCityId();
		 $resource = Mage::getSingleton('core/resource');
         $read = $resource->getConnection('core_read');
		 $select = $read->select()->from(array('city' => 'mec_directory_country_region_city'))->where('city.id=?', $city_id);
		 $data = $read->fetchAll($select);
		 $region_code = '';
		 foreach($data as $_row){
			$region_code = $_row['region_code'];
		 }
	    $select_region = $read->select()->from(array('region' => 'directory_country_region'))->where('region.code=?', $region_code);
		$region_data = $read->fetchAll($select_region);
		foreach($region_data as $_region){
			$html = $_region['default_name'];
		}	
		 return $html;
	 }

}