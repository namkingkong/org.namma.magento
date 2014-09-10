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
			->_setActiveMenu('sm_module');

		return $this;
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

		$model = Mage::getModel('sm_slider/slider');

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
}
