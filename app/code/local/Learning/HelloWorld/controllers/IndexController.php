<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/4/14
 * Time: 3:37 PM
 */
class Learning_HelloWorld_IndexController extends Mage_Core_Controller_Front_Action {

	public function indexAction() {
		echo '<h1 style="position:fixed;background:#3399cc;color:white;border-radius:0 0 6px 0;padding:10px;margin:0;box-shadow:0 1px 2px #444;z-index:2;">
				Hello, World!<br>Module = Learning_HelloWorld
			</h1>';

		$this->loadLayout();
		$this->renderLayout();
	}

}
