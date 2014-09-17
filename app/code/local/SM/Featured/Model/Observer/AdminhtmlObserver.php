<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/17/14
 * Time: 12:20 AM
 */
class SM_Featured_Model_Observer_AdminhtmlObserver {

	public function addCatalogProductGridMassAction($observer) {
		$block = $observer->getBlock();

		$block->getMassactionBlock()->addItem('enableFeatured', array(
			'label'     => Mage::helper('sm_featured')->__('Add to Featured Product List'),
			'url'       => Mage::getUrl('*/featuredProduct/massEnable'),
			'confirm'   => 'Enable, hey?'
		));

		$block->getMassactionBlock()->addItem('disableFeatured', array(
			'label'     => Mage::helper('sm_featured')->__('Remove from Featured Product List'),
			'url'       => Mage::getUrl('*/featuredProduct/massDisable'),
			'confirm'   => 'Disable, hey?'
		));
	}

}