<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/16/14
 * Time: 5:16 PM
 */
class SM_Featured_Adminhtml_FeaturedProductController extends Mage_Adminhtml_Controller_Action {

	public function indexAction() {
		echo 'Hello';
	}

	public function massEnableAction() {
		$count = $this->_changeIsFeaturedStatus(true);

		Mage::getSingleton('adminhtml/session')->addSuccess("Successfully enable featured status of {$count} products");

		return $this->_redirectReferer();
	}

	public function massDisableAction() {
		$count = $this->_changeIsFeaturedStatus(false);

		Mage::getSingleton('adminhtml/session')->addSuccess("Successfully disable featured status of {$count} products");

		return $this->_redirectReferer();
	}

	/**
	 * @param boolean $status
	 */
	private function _changeIsFeaturedStatus($status) {
		$ids = $this->getRequest()->getParam('product');

		$products = Mage::getModel('catalog/product')->getCollection()
			->addAttributeToFilter('entity_id', array('in' => $ids))
			->addAttributeToFilter('is_featured', array('neq' => $status));

		$count = 0;

		/** @var Mage_Catalog_Model_Product $product */
		foreach ($products as $product) {
			$product->setData('is_featured', $status)->getResource()->saveAttribute($product, 'is_featured');
			++$count;
		}

		return $count;
	}

}