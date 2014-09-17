<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/16/14
 * Time: 5:16 PM
 */
class SM_Featured_Adminhtml_FeaturedProductController extends Mage_Adminhtml_Controller_Action {

	public function indexAction() {
		$products = Mage::getBlockSingleton('sm_featured/featuredProductSlider')->getWebsiteFeaturedProducts();

		echo '<ol>';

		foreach ($products as $product) {
			$product->load($product->getId());
			echo "<li>{$product->getName()}</li>";
		}

		echo '</ol>';
	}

	public function massivelyChangeFeaturedStatusAction() {
		$ids    = $this->getRequest()->getParam('product');
		$status = $this->getRequest()->getParam('status');

		$count = $this->_changeFeaturedStatus($ids, $status);

		$status = $status ? 'enabled' : 'disabled';
		Mage::getSingleton('adminhtml/session')->addSuccess("Successfully {$status} featured status of {$count} products");

		return $this->_redirectReferer();
	}

	public function massivelyChangeFeaturedPlaceAction() {
		$ids    = $this->getRequest()->getParam('product');
		$placeId= $this->getRequest()->getParam('place_id');

		$count = $this->_changeFeaturedPlace($ids, $placeId);

		$place = Mage::getModel('sm_featured/source_featuredPlace')->getPlaceName($placeId);
		Mage::getSingleton('adminhtml/session')->addSuccess("Successfully change featured place of {$count} products to {$place}");

		return $this->_redirectReferer();
	}

	/**
	 * @param array $ids
	 *      An array of ID of products to be updated
	 * @param boolean $status
	 *      The new featured status
	 * @return int
	 *      Number of products updated
	 */
	private function _changeFeaturedStatus($ids, $status) {
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

	private function _changeFeaturedPlace($ids, $placeId) {
		$products = Mage::getModel('catalog/product')->getCollection()
			->addAttributeToFilter('entity_id', array('in' => $ids))
			->addAttributeToFilter('is_featured', 1)
			->addAttributeToFilter('featured_place', array('neq' => $placeId));

		$count = 0;

		foreach ($products as $product) {
			$product->setData('featured_place', $placeId)->getResource()->saveAttribute($product, 'featured_place');
			++$count;
		}

		return $count;
	}

}