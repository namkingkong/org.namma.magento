<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/9/14
 * Time: 4:55 PM
 */
class SM_Slider_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('sm_module');

		return $this;
	}

	public function indexAction() {
		$this->_initAction();

//		$this->getLayout()->addBlock(
//			'sm_slider_text_block',
//			$this->getLayout()->createBlock('core/text')->setText('<h1>Hello, World!</h1>')
//		);

		$this->renderLayout();
	}

}
