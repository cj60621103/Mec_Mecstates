<?php

class Mec_Mecstates_Block_Adminhtml_Area_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("areaGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("ASC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("mecstates/area")->getCollection();
				$this->setCollection($collection);
				
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				 $this->addColumn(
					'id', array(
									  'header'           => Mage::helper('mecstates')->__('Region'),
									  'align'            => 'left',
									  'width'            => '5',
									  'index'            => 'id',
									  'column_css_class' => 'row_id',
									  'sortable'         => false,
									  'filter'           => false,
									  'renderer'  =>     'Mec_Mecstates_Block_Adminhtml_Renderer_Region',
								 )
				  );
				  
				  
				  $this->addColumn(
					'city_id', array(
									  'header'           => Mage::helper('mecstates')->__('City'),
									  'align'            => 'left',
									  'width'            => '5',
									  'type'             => 'options',
									  'index'            => 'city_id',
									  'options'          => Mage::helper('mecstates')->CityToOptionArray(),	  									  
								 )
				  );
				  
				  $this->addColumn(
					'district', array(
									  'header'           => Mage::helper('mecstates')->__('Area'),
									  'align'            => 'left',
									  'width'            => '110px',
									  'index'            => 'district',
									 
								 )
				  );
				  
				  
                

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_area', array(
					 'label'=> Mage::helper('mecstates')->__('Remove Area'),
					 'url'  => $this->getUrl('*/adminhtml_area/massRemove'),
					 'confirm' => Mage::helper('mecstates')->__('Are you sure?')
				));
			return $this;
		}
			

}