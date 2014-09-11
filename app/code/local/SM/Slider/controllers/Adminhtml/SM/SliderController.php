<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/9/14
 * Time: 4:55 PM
 */
class SM_Slider_Adminhtml_SM_SliderController extends Mage_Adminhtml_Controller_Action {

	protected function _init() {
		$this->loadLayout()
			->_setActiveMenu('sm_module')
			->_title($this->__('SM Modules'), $this->__('Slider'))
			->_addBreadcrumb($this->__('SM Modules'), $this->__('SM Modules'))
			->_addBreadcrumb($this->__('Slider'), $this->__('Slider'));

		return $this;
	}

	protected function _isAllowed() {
		return Mage::getSingleton('admin/session')->isAllowed('sm_module/sm_slider');
	}

	protected function _getWriteConnection() {
		return Mage::getSingleton('core/resource')->getConnection('core_write');
	}

	public function indexAction() {
		$this->_init()->renderLayout();
	}

	public function newAction() {
		$this->_forward('edit');
	}

	public function editAction() {
		// Get model ID if available
		$id = $this->getRequest()->getParam('id');

		$model = Mage::getModel('sm_slider/slider');http://www.pierrefay.com/

		if ($id) {
			// Load model entity
			$model->load($id);

			// Check if the entity was unsuccessfully loaded
			// (There are some reasons causing it's failed to load, .eg ID does not exist...)
			if (! $model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('The requested slider is not available'));
				return $this->_redirect('*/*');
			}
		}

		$this->_title($model->getId() ? $model->getName() : $this->__('New Slider'));

		$data = Mage::getSingleton('adminhtml/session')->getSliderData(true);
		if (! empty($data)) {
			$model->setData($data);
		}

		Mage::register('sm_slider_slider', $model);

		$this->_init()
			->_addBreadcrumb(
				$id ? $this->__('Edit Slider') : $this->__('New Slider'),
				$id ? $this->__('Edit Slider') : $this->__('New Slider')
			)
			->_addContent(
					$this->getLayout()
						->createBlock('sm_slider/adminhtml_slider_edit')
						->setData('action', $this->getUrl('*/*/save'))
			)
			->renderLayout();
	}

	public function saveAction()
	{
		if ($postData = $this->getRequest()->getPost())
		{
			// Analyze and set value for "is_active" field
			if (isset($postData['is_active'])) {
				$postData['is_active'] = true;
			}
			else {
				$postData['is_active'] = false;
			}

			// Create model instance using the submitted data
			$model = Mage::getSingleton('sm_slider/slider');
			$model->setData($postData);

			$adminHtmlSession = Mage::getSingleton('adminhtml/session');
			$connection = $this->_getWriteConnection();

			try
			{
				$connection->beginTransaction();

				{
					/*
					 * There is only 1 slider may be active.
					 * So if this slider is set to be active,
					 * find the currently active one to de-activate it before save this.
					 */
					if ($postData['is_active']) {
						// Execute update query
						$connection->update(
							// This is table name
							Mage::getSingleton('core/resource')->getTableName('sm_slider/slider'),
							// This is changes you wanna make
							array(
								'is_active' => false
							),
							// This is the record-seeking condition (aka WHERE) =))
							array(
								'is_active' => true
							)
						);
					}

					// Save this entity
					$model->save();
				}

				$connection->commit();

				$adminHtmlSession->addSuccess($this->__('The slider has bean saved'));

				return $this->_redirect('*/*');
			}
			catch (Mage_Core_Exception $ex)
			{
				$connection->rollback();
				$adminHtmlSession->addError($ex->getMessage());
			}
			catch (Mage_Core_Exception $ex)
			{
				$connection->rollback();
				$adminHtmlSession->addError($this->__('An error occured while saving the slider'));
			}

			/*
			 * These 2 lines of code is only executed when there is exception
			 */
			$adminHtmlSession->setSliderData($postData);
			$this->_redirectPrefer();
		}
	}

	public function deleteAction() {
		$id = $this->getRequest()->getParam('id');
		$model = Mage::getModel('sm_slider/slider')->load($id);
		$adminHtmlSession = Mage::getSingleton('adminhtml/session');

		/*
		 * If this ID is not available
		 */
		if (! $model->getId()) {
			$adminHtmlSession->addError($this->__('The requested slider is not available'));
		}
		else {
			$model->delete();
			$adminHtmlSession->addSuccess($this->__('The slider is deleted'));
		}

		return $this->_redirect('*/*');
	}

	public function messageAction() {
		$data = Mage::getModel('sm_slider/slider')->load($this->getRequest()->getParam('id'));
		echo $data->getContent();
	}
}
