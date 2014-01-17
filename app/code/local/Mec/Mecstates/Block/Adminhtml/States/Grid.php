<?php

class Mec_Mecstates_Block_Adminhtml_States_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("statesGrid");
				$this->setDefaultSort("region_id");
				$this->setDefaultDir("ASC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("mecstates/states")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				  $this->addColumn(
					'region_id', array(
									  'header'           => Mage::helper('mecstates')->__('ID'),
									  'align'            => 'left',
									  'width'            => '5',
									  'index'            => 'region_id',
									  'column_css_class' => 'row_id'
								 )
				);
				
				$this->addColumn(
					'country_id', array(
									   'header' => Mage::helper('mecstates')->__('Country Code'),
									   'align'  => 'left',
									   'width'  => '110px',
									   'index'  => 'country_id',
									   'type'   => 'country',
								  )
				);
				
				$this->addColumn(
					'code', array(
									 'header'           => Mage::helper('mecstates')->__('Region Code'),
									 'align'            => 'left',
									 'width'            => '110px',
									 'index'            => 'code',
									 //'editable' =>true,
									 'column_css_class' => 'code_td'
								)
				);
				
				$this->addColumn(
					'default_name', array(
										 'header'           => Mage::helper('mecstates')->__('Default Name'),
										 'align'            => 'left',
										 'width'            => '110px',
										 'index'            => 'default_name',
										 //'editable' =>true,
										 'column_css_class' => 'default_name'
									)
				);
					
				
				
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}

		
		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('region_id');
			$this->getMassactionBlock()->setFormFieldName('region_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_states', array(
					 'label'=> Mage::helper('mecstates')->__('Remove States'),
					 'url'  => $this->getUrl('*/adminhtml_states/massRemove'),
					 'confirm' => Mage::helper('mecstates')->__('Are you sure?')
				));
			return $this;
		}
			

}