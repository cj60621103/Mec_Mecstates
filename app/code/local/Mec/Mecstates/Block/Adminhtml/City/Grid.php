<?php

class Mec_Mecstates_Block_Adminhtml_City_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("cityGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("ASC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("mecstates/city")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				  $this->addColumn(
					'id', array(
									  'header'           => Mage::helper('mecstates')->__('ID'),
									  'align'            => 'left',
									  'width'            => '5',
									  'index'            => 'id',
									  'column_css_class' => 'row_id'
								 )
				  );
                
				 
				  $this->addColumn(
					'region_code', array(
									  'header'           => Mage::helper('mecstates')->__('Region'),
									  'align'            => 'left',
									  'width'            => '5',
									  'type'             => 'options',
									  'index'            => 'region_code',
									  'options'          => Mage::helper('mecstates')->RegionToOptionArray()
								 )
				  );
				 
				 $this->addColumn(
					'city', array(
										 'header'           => Mage::helper('mecstates')->__('Default Name'),
										 'align'            => 'left',
										 'width'            => '110px',
										 'index'            => 'city',
										 //'editable' =>true,
										 'column_css_class' => 'city'
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
			$this->getMassactionBlock()->addItem('remove_city', array(
					 'label'=> Mage::helper('mecstates')->__('Remove City'),
					 'url'  => $this->getUrl('*/adminhtml_city/massRemove'),
					 'confirm' => Mage::helper('mecstates')->__('Are you sure?')
				));
			return $this;
		}
			

}