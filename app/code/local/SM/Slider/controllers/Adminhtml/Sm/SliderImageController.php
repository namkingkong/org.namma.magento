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

	public function indexAction() {
		// Get Slider Image Controller
		$id = $this->getRequest()->getParam('id');

		$this->_init();

		$this->getLayout()
			->getBlock('content')
			->append(
				$this->getLayout()->createBlock(
					'sm_slider/adminhtml_image_formContainer',
					'sm_slider_image_edit'
				)
			);

		$this->renderLayout();
	}

}
