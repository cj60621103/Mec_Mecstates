<?php

class Mec_Mecstates_Adminhtml_AreaController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("mecstates/area")->_addBreadcrumb(Mage::helper("adminhtml")->__("Area  Manager"),Mage::helper("adminhtml")->__("Area Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Mecstates"));
			    $this->_title($this->__("Manager Area"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Mecstates"));
				$this->_title($this->__("Area"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("mecstates/area")->load($id);
				if ($model->getId()) {
					Mage::register("area_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("mecstates/area");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Area Manager"), Mage::helper("adminhtml")->__("Area Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Area Description"), Mage::helper("adminhtml")->__("Area Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("mecstates/adminhtml_area_edit"))->_addLeft($this->getLayout()->createBlock("mecstates/adminhtml_area_edit_tabs"));
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
		$this->_title($this->__("Area"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("mecstates/area")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("area_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("mecstates/area");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Area Manager"), Mage::helper("adminhtml")->__("Area Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Area Description"), Mage::helper("adminhtml")->__("Area Description"));


		$this->_addContent($this->getLayout()->createBlock("mecstates/adminhtml_area_edit"))->_addLeft($this->getLayout()->createBlock("mecstates/adminhtml_area_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {
						
						
						if($this->getRequest()->getParam("id") == null){
							$flag = Mage::helper('mecstates')->validationSaveAreaData($post_data['city_id'], $post_data['district']);
							if(!$flag){
								Mage::getSingleton("adminhtml/session")->addError(Mage::helper("adminhtml")->__("Area Name Repeat In System"));
								Mage::getSingleton("adminhtml/session")->setStatesData($this->getRequest()->getPost());
								$this->_redirectReferer();
								return;
							}
						}
						

						$model = Mage::getModel("mecstates/area")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Area was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setAreaData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setAreaData($this->getRequest()->getPost());
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
						$model = Mage::getModel("mecstates/area");
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
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("mecstates/area");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
}
