<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/8/14
 * Time: 2:15 PM
 */
class SM_MegaMenu_Admin_IndexController extends Mage_Adminhtml_Controller_Action {

	public function indexAction() {
		$this->loadLayout();
		$this->renderLayout();
	}

}
