<?php

class Mec_Mecstates_Adminhtml_CityController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("mecstates/city")->_addBreadcrumb(Mage::helper("adminhtml")->__("City  Manager"),Mage::helper("adminhtml")->__("City Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Mecstates"));
			    $this->_title($this->__("Manager City"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Mecstates"));
				$this->_title($this->__("City"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("mecstates/city")->load($id);
				if ($model->getId()) {
					Mage::register("city_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("mecstates/city");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("City Manager"), Mage::helper("adminhtml")->__("City Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("City Description"), Mage::helper("adminhtml")->__("City Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("mecstates/adminhtml_city_edit"))->_addLeft($this->getLayout()->createBlock("mecstates/adminhtml_city_edit_tabs"));
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
		$this->_title($this->__("City"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("mecstates/city")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("city_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("mecstates/city");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("City Manager"), Mage::helper("adminhtml")->__("City Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("City Description"), Mage::helper("adminhtml")->__("City Description"));


		$this->_addContent($this->getLayout()->createBlock("mecstates/adminhtml_city_edit"))->_addLeft($this->getLayout()->createBlock("mecstates/adminhtml_city_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {
						
						if($this->getRequest()->getParam("id") == null){
							$flag = Mage::helper('mecstates')->validationSaveCityData($post_data['region_code'], $post_data['city']);
							if(!$flag){
								Mage::getSingleton("adminhtml/session")->addError(Mage::helper("adminhtml")->__("City Name Repeat In System"));
								Mage::getSingleton("adminhtml/session")->setStatesData($this->getRequest()->getPost());
								$this->_redirectReferer();
								return;
							}
							
						}
						

						$model = Mage::getModel("mecstates/city")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("City was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setCityData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setCityData($this->getRequest()->getPost());
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
						$model = Mage::getModel("mecstates/city");
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
                      $model = Mage::getModel("mecstates/city");
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
