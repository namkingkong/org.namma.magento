<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/6/14
 * Time: 1:39 AM
 */
class SM_MegaMenu_Block_MegaMenu extends Mage_Core_Block_Template {

	public function getAllMenuItems() {
		$menuItems = Mage::getModel('sm_megamenu/item')
			->getCollection()
			->addFieldToFilter('is_active', true)
			->setOrder('`order`', 'asc');

		return $menuItems;
	}

	/**
	 * @return array All menu items
	 */
	public function getMenuItems() {
		$storeId = Mage::app()->getStore()->getId();

		$menuItems = Mage::getModel('sm_megamenu/item')
			->getCollection()
			->addFieldToFilter('store_id', $storeId)
			->addFieldToFilter('is_active', true)
			->setOrder('`order`', 'asc');

		return $menuItems;
	}

	/**
	 * @return string Get HTML code of Category Tree in the Mega Menu
	 */
	public function getCategoriesHtml() {
		// Get current store's root category ID
		$rootCategoryId = Mage::app()->getStore()->getRootCategoryId();

		$rootCategory = Mage::getModel('catalog/category')->load($rootCategoryId);

		$childrenIds = explode(',', $rootCategory->getChildren());

		$html = '<ul>';

		foreach ($childrenIds as $childId) {
			$html .= $this->_buildCategoriesHtml($childId);
		}

		$html .= '</ul>';

		return $html;
	}

	protected function _buildCategoriesHtml($rootCategoryId) {
		$category = Mage::getModel('catalog/category')->load($rootCategoryId);

		$html = '<li>';

		$html .= "<a href='{$category->getUrl()}'>{$category->getName()}</a>";

		$childrenIds = $category->getChildren();

		if (! empty($childrenIds)) {
			$childrenIds = explode(',', $category->getChildren());

			$html .= '<ul>';

			foreach ($childrenIds as $childId) {
				$html .= $this->_buildCategoriesHtml($childId);
			}

			$html .= '</ul>';
		}

		$html .= '</li>';

		return $html;
	}
}
