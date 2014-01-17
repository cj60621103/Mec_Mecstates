<?php

class Mec_Mecstates_Adminhtml_StatesController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("mecstates/states")->_addBreadcrumb(Mage::helper("adminhtml")->__("States  Manager"),Mage::helper("adminhtml")->__("States Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Mecstates"));
			    $this->_title($this->__("Manager States"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Mecstates"));
				$this->_title($this->__("States"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("mecstates/states")->load($id);
				if ($model->getId()) {
					Mage::register("states_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("mecstates/states");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("States Manager"), Mage::helper("adminhtml")->__("States Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("States Description"), Mage::helper("adminhtml")->__("States Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("mecstates/adminhtml_states_edit"))->_addLeft($this->getLayout()->createBlock("mecstates/adminhtml_states_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("mecstates")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Mecstates"));
		$this->_title($this->__("States"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("mecstates/states")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("states_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("mecstates/states");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("States Manager"), Mage::helper("adminhtml")->__("States Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("States Description"), Mage::helper("adminhtml")->__("States Description"));


		$this->_addContent($this->getLayout()->createBlock("mecstates/adminhtml_states_edit"))->_addLeft($this->getLayout()->createBlock("mecstates/adminhtml_states_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {
						
						
						
						$save_flag = Mage::helper('mecstates')->validationSaveData($post_data['country_id'], $post_data['code']);
						
						if(!$save_flag){
							Mage::getSingleton("adminhtml/session")->addError(Mage::helper("adminhtml")->__("Region Code Repeat In System"));
							Mage::getSingleton("adminhtml/session")->setStatesData($this->getRequest()->getPost());
							$this->_redirectReferer();
							return;
						}
						
						
						
						$model = Mage::getModel("mecstates/states")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("States was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setStatesData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setStatesData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("mecstates/states");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('region_ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("mecstates/states");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'states.csv';
			$grid       = $this->getLayout()->createBlock('mecstates/adminhtml_states_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'states.xml';
			$grid       = $this->getLayout()->createBlock('mecstates/adminhtml_states_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
