<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/12/14
 * Time: 10:45 AM
 */
class SM_Slider_Adminhtml_Sm_SliderImageController extends Mage_Adminhtml_Controller_Action {

	protected function _init() {
		$this->loadLayout();

		// Setup some config
		$this->_setActiveMenu('sm_module')
			->_title($this->__('SM Modules'), $this->__('Slider'), $this->__('Image'))
			->_addBreadCrumb($this->__('SM Modules'), $this->__('SM Modules'))
			->_addBreadCrumb($this->__('Slider'), $this->__('Slider'))
			->_addBreadCrumb($this->__('Image'), $this->__('Image'));

		return $this;
	}
	
	public function newAction() {
		$this->_forward('edit');
	}

	public function editAction() {
		// Get Slider Image Controller
		$id = $this->getRequest()->getParam('id');

		$model = Mage::getModel('sm_slider/image');

		// If image ID is given, load the image from DB
		if ($id) {

			$model->load($id);

			/*
			 * If the image having the ID does not exist,
			 * return to the slider edit page
			 */
			if (! $model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('The requested image is not available'));
				return $this->_redirect('*/sm_slider/index');
			}
		}

		// Set page title
		$this->_title($model->getId() ?
			$model->getName()           // If edit
			: $this->__('New Slider')); // If new

//		$data = Mage::getSingleton('adminhtml/session')->getImageData(true);
//		if (! empty($data)) {
//			$model->setData($data);
//		}

		// Add model to registry so that view page can spread the data on all form fields
		Mage::register('sm_slider_image', $model);

		$this->_init();

		$this->_addContent(
			$this->getLayout()->createBlock('sm_slider/adminhtml_image_edit')
		);

		$this->renderLayout();
	}

	public function saveAction() {

		$adminHtmlSession = Mage::getSingleton('adminhtml/session');

		if ($postData = $this->getRequest()->getPost()) {
			// Analyze and set value for "is_active" field
			if (isset($postData['is_active'])) {
				$postData['is_active'] = true;
			}
			else {
				$postData['is_active'] = false;
			}

			// Create model instance using the submitted data
			$model = Mage::getSingleton('sm_slider/image');
			$model->setData($postData);

			// Set slider ID if given
			if ($sliderId = $this->getRequest()->getParam('slider_id')) {
				$model->setSliderId($sliderId);
			}

			try
			{
				// Save this entity
				$model->save();

				$adminHtmlSession->addSuccess($this->__('The slider has bean saved'));

				// After successfully saving the image, return to slider edit page
				return $this->_redirect("*/sm_slider/edit/id/{$sliderId}");
			}
			catch (Mage_Core_Exception $ex)
			{
				$adminHtmlSession->addError($ex->getMessage());
			}
			catch (Mage_Core_Exception $ex)
			{
				$adminHtmlSession->addError($this->__('An error occured while saving the slider'));
			}

			/*
			 * These 2 lines of code is only executed when there is exception
			 */
			$adminHtmlSession->setSliderData($postData);
			$this->_redirectReferer();
		}
	}

	public function deleteAction() {
		$id = $this->getRequest()->getParam('id');

		$image = Mage::getModel('sm_slider/image')->load($id);

		// If the image is successfully loaded with the given ID
		if ($image->getId()) {
			// Remove this image record from DB
			$image->delete();
			// Redirect to slider page
			return $this->_redirect("*/sm_slider/edit/id/{$image->getSliderId()}");
		}
		// Else, if failed to load, show error
		else {
			Mage::getSingleton('adminhtml/session')->addError("Failed to load image");
			$this->_init()->renderLayout();
		}
	}
}
