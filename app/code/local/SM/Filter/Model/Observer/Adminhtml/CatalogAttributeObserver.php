<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/25/14
 * Time: 11:39 AM
 */
class SM_Filter_Model_Observer_Adminhtml_CatalogAttributeObserver {

	public function addAttributeManagementFormField($observer) {
		$block = $observer->getBlock();

		if ($block instanceof Mage_Adminhtml_Block_Catalog_Product_Attribute_Edit_Tab_Main) {
			$form = $block->getForm();

			$fieldset = $form->addFieldset(
				'filter_display_type_fieldset',
				array(
					'legend'    => Mage::helper('sm_filter')->__('Filter Display Type'),
					'class'     => 'fieldset-wide'
				)
			);

			$fieldset->addField(
				'filter_display_type',
				'select',
				array(
					'name'      => 'filter_display_type',
					'label'     => Mage::helper('sm_filter')->__('Filter Display Type'),
					'title'     => Mage::helper('sm_filter')->__('Filter Display Type'),
					'values'    => Mage::getModel('sm_filter/source_filterDisplayTypeOptions')->getAllOptions()
				)
			);
		}
	}

}