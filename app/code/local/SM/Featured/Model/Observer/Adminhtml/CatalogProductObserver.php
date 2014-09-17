<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/17/14
 * Time: 12:20 AM
 */
class SM_Featured_Model_Observer_Adminhtml_CatalogProductObserver {

	public function addGridMassAction($observer) {

		$block = $observer->getBlock();

		$block->getMassactionBlock()->addItem('changeFeaturedStatus', array(
			'label'     => Mage::helper('sm_featured')->__('Change Featured Status'),
			'url'       => Mage::getUrl('*/featuredProduct/massivelyChangeFeaturedStatus'),
			'confirm'   => 'Massively change, huh?',
			'additional' => array(
				'status' => array(
					'name'  => 'status',
					'type'  => 'select',
					'class' => 'required-entry',
					'label' => Mage::helper('sm_featured')->__('Status'),
					'values'=> Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray()
				)
			)
		));

		$block->getMassactionBlock()->addItem('changeFeaturedPlace', array(
			'label'     => Mage::helper('sm_featured')->__('Change Featured Place'),
			'url'       => Mage::getUrl('*/featuredProduct/massivelyChangeFeaturedPlace'),
			'confirm'   => 'Massively change, huh?',
			'additional' => array(
				'place' => array(
					'name'  => 'place_id',
					'type'  => 'select',
					'class' => 'required-entry',
					'label' => Mage::helper('sm_featured')->__('Show the selected featured products on'),
					'values'=> Mage::getModel('sm_featured/source_featuredPlace')->toOptionArray()
				)
			)
		));
	}

	public function beforeBlockHtml(Varien_Event_Observer $observer)
	{
		$grid = $observer->getBlock();

		/*
		 * Check if this grid is Catalog Product Grid
		 */
		if ($grid instanceof Mage_Adminhtml_Block_Catalog_Product_Grid) {
			$grid->addColumnAfter(
				'is_featured',
				array(
					'header'    => Mage::helper('sm_featured')->__('Is Featured Product'),
					'index'     => 'is_featured',
					'type'      => 'options',
					'options'   => array(
						1 => 'Yes',
						0 => 'No',
					),
					'width'     => '50px',
					'align'     => 'center'
				),
				'name'
			);

			$grid->addColumnAfter(
				'featured_place',
				array(
					'header'    => Mage::helper('sm_featured')->__('Featured Place'),
					'index'     => 'featured_place',
					'type'      => 'options',
					'options'   => Mage::getModel('sm_featured/source_featuredPlace')->toArray(),
					'width'     => '50px',
					'align'     => 'center'
				),
				'is_featured'
			);
		}
	}

	public function beforeCollectionLoad(Varien_Event_Observer $observer) {
		$collection = $observer->getCollection();

		if ($collection instanceof Mage_Catalog_Model_Resource_Product_Collection) {
			$collection->addAttributeToSelect(array('is_featured', 'featured_place'));
		}
	}

}