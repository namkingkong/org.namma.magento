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
	public function getWebsiteFeaturedProducts() {
		return $this->_getFeaturedProducts(array(
			SM_Featured_Model_Source_FeaturedPlace::BOTH_VALUE,
			SM_Featured_Model_Source_FeaturedPlace::WEBSITE_VALUE
		));
	}

	/**
	 * Return Category Featured Products

	 * @return Mage_Catalog_Model_Resource_Product_Collection
	 */
	public function getCategoryFeaturedProducts() {
		return $this->_getFeaturedProducts(array(
			SM_Featured_Model_Source_FeaturedPlace::BOTH_VALUE,
			SM_Featured_Model_Source_FeaturedPlace::CATEGORY_VALUE
		));
	}

	/**
	 * @param array $placeIds
	 * @return Mage_Catalog_Model_Resource_Product_Collection
	 */
	protected function _getFeaturedProducts($placeIds) {
		return Mage::getModel('catalog/product')->getCollection()
			->addAttributeToFilter('is_featured', 1)
			->addAttributeToFilter('featured_place', array('in' => $placeIds));
	}

}