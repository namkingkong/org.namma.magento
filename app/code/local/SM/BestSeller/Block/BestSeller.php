<?php
/**
 * Created by PhpStorm.
 * User: NamMA
 * Date: 9/24/14
 * Time: 3:45 PM
 */
class SM_BestSeller_Block_BestSeller extends Mage_Core_Block_Template {

    public function getBestSellerProducts() {
        $storeId = Mage::app()->getStore()->getId();

        $products = Mage::getResourceModel('reports/product_collection')
            ->addOrderedQty()
//            ->addAttributeToSelect('*')
            ->addAttributeToSelect(array('name', 'price', 'small_image'))
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->setOrder('ordered_qty', 'desc');

	    if (($currentCategory = Mage::registry('current_category')) !== null) {
		    $products
		        ->joinField('category_id', 'catalog/category_product', 'category_id', 'product_id = entity_id')
			    ->addAttributeToFilter('category_id', array('in', $this->_getAllSubCategories($currentCategory->getId())));
	    }

        // Filter collection with product status
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);

        // Filter collection with product visibility
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);

        // Set limit quantity from system configuration
	    $products->setPageSize(10)->setCurPage(1);

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