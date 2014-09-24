<?php
/**
 * Created by PhpStorm.
 * User: NamMA
 * Date: 9/24/14
 * Time: 3:45 PM
 */
class SM_BestSeller_Block_BestSeller extends Mage_Core_Block_Abstract {

    public function getBestSellerProducts() {
        $storeId = Mage::app()->getStore()->getId();

        $products = Mage::getResourceModel('catalog/product_collection')
            ->addOrdererQty()
            ->addAttributeToSelect('*')
            ->addAttributeToSelect(array('name', 'price', 'small_image'))
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->setOrder('ordered_qty', 'desc');

        // Filter collection with product status
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);

        // Filter collection with product visibility
        Mage::getSingleton('catalog/product_visibility')->addVisibleFilterCollection($products);

        // Set limit quantity from system configuration
        /*
         * Code here...
         */

        return $products;
    }

}