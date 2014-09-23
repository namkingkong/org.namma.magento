<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/17/14
 * Time: 5:28 PM
 */
class SM_Featured_Block_FeaturedProductSlider extends Mage_Core_Block_Template {

	/**
	 * Return Website Featured Products
	 *
	 * @return Mage_Catalog_Model_Resource_Product_Collection
	 */
	public function getWebsiteFeaturedProducts($quantity) {
		return $this->_getFeaturedProducts(array(
			SM_Featured_Model_Source_FeaturedPlace::BOTH_VALUE,
			SM_Featured_Model_Source_FeaturedPlace::WEBSITE_VALUE
		), $quantity);
	}

	/**
	 * Return Category Featured Products

	 * @return Mage_Catalog_Model_Resource_Product_Collection
	 */
	public function getCategoryFeaturedProducts($quantity) {
		return $this->_getFeaturedProducts(array(
			SM_Featured_Model_Source_FeaturedPlace::BOTH_VALUE,
			SM_Featured_Model_Source_FeaturedPlace::CATEGORY_VALUE
		), $quantity);
	}

	/**
	 * @param array $placeIds
	 * @return Mage_Catalog_Model_Resource_Product_Collection
	 */
	protected function _getFeaturedProducts($placeIds, $quantity = null) {
		$products = Mage::getModel('catalog/product')->getCollection()
			->addAttributeToFilter('is_featured', 1)
			->addAttributeToFilter('featured_place', array('in' => $placeIds))
			->addAttributeToFilter('visibility', Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
			->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED);

		if ($quantity !== null) {
			$products->setPageSize($quantity)->setCurPage(1);
		}

		// Filter by category if current category differ ABSOLUTELY from null
		if (($currentCategory = Mage::registry('current_category')) !== null) {
			$products
				->joinField('category_id', 'catalog/category_product', 'category_id', 'product_id = entity_id', null, 'left')
				->addAttributeToFilter('category_id', array('in' => $this->_getAllSubCategories($currentCategory->getId())));
		}

		return $products;
	}

	public function getCurrentCurrencySymbol() {
		return Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
	}

	private function _getAllSubCategories($rootId) {
		$tree = array($rootId);

		$children = Mage::getModel('catalog/category')
			->getCollection()
			->addAttributeToFilter('parent_id', $rootId);

		foreach ($children as $child) {
			$tree = array_merge($tree, $this->_getAllSubCategories($child->getId()));
		}

		return $tree;
	}

}