<?php
/**
 * Created by PhpStorm.
 * User: NamMA
 * Date: 9/24/14
 * Time: 3:45 PM
 */
class SM_BestSeller_Block_BestSeller extends Mage_Core_Block_Template {

    public function getBestSellerProducts($maximumQty = null) {
        $storeId = Mage::app()->getStore()->getId();

	    $periodOfTime = Mage::getStoreConfig('sm_bestseller/display/period_of_time');
	    $fromDate = (new Zend_Date())->subDay($periodOfTime);

        $products = Mage::getResourceModel('reports/product_collection')
            ->addOrderedQty()
            ->addAttributeToSelect(array('name', 'price', 'small_image'))
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->setOrder('ordered_qty', 'desc');

	    // Add category filter if currently in a category page
	    if (($currentCategory = Mage::registry('current_category')) !== null) {
		    $products->addCategoryFilter($currentCategory);
	    }

        // Filter collection with product status
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);

        // Filter collection with product visibility
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);

        // Set limit quantity from system configuration
	    if ($maximumQty !== null) {
		    $products->setPageSize($maximumQty)->setCurPage(1);
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