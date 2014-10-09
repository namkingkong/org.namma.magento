<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 2:22 PM
 */
class SM_MegaMenu2_Model_Source_CategoryList
{
	public function getOptionsArray()
	{
		$categories = Mage::getModel('catalog/category')->getCollection()->addAttributeToSelect(array('name'));

		$options = array();

		foreach ($categories as $category) {
			$options[$category->getId()] = $category->getName();
		}

		return $options;
	}
}