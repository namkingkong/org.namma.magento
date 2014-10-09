<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 2:14 AM
 */
class SM_MegaMenu2_Adminhtml_MegaMenu2Controller extends Mage_Adminhtml_Controller_Action
{
	/**
	 * Initialize commons for layout
	 *
	 * @return $this
	 */
	protected function _initLayout()
	{
		$layout = $this->loadLayout();

		$layout->_setActiveMenu('sm_module');
		$layout->_title($this->__('Manage Mega Menu v2'));
		$layout->_addBreadcrumb($this->__('SM Modules'), $this->__('SM Modules'))
			->_addBreadcrumb($this->__('Manage Mega Menu v2'), $this->__('Manage Mega Menu v2'));

		return $this;
	}

	protected function _prepareFormContainer()
	{
		$item = Mage::getModel('sm_megamenu2/item');

		$itemId = $this->getRequest()->getParam('id');

		if ($itemId) {
			$item->load($itemId);

			if (! $item->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('The requested menu item ís not available'));
				return $this->_redirect('*/*');
			}
		}

		$this->_title($itemId ? $this->__('Create new menu item') : $this->__('Edit menu item'));

		$flashData = Mage::getSingleton('adminhtml/session')->getItemData(true);
		if (! empty($flashData)) {
			$item->setData($flashData);
		}

		Mage::register('sm_megamenu2_item', $item);

		$this->_initLayout();

		$this->_addBreadcrumb(
			$itemId ? $this->__('Edit Product Label') : $this->__('Create New Product Label'),
			$itemId ? $this->__('Edit Product Label') : $this->__('Create New Product Label')
		);

		$this->_addContent(
			$this->getLayout()->createBlock(
				'sm_megamenu2/adminhtml_item_edit',
				'sm_megamenu2_item_edit',
				array(
					'action' => $this->getUrl('*/*/save')
				)
			)
		);

		$this->renderLayout();
	}

	public function indexAction()
	{
		$this->_initLayout();

		$this->_addContent(
			$this->getLayout()->createBlock('sm_megamenu2/adminhtml_item')
		);

		$this->renderLayout();
	}

	public function newAction()
	{
		$this->_prepareFormContainer();
	}

	public function editAction()
	{
		$this->_prepareFormContainer();
	}

	public function saveAction()
	{
		if ($data = $this->getRequest()->getPost())
		{
			$session = Mage::getSingleton('adminhtml/session');

			try {
				$item = Mage::getModel('sm_megamenu2/item')->setData($data)->save();

				$session->addSuccess($this->__('New menu item created successfully'));

				return $this->_redirect('*/*');
			}
			catch (Exception $ex) {
				$session->addError('Error message: ' . $ex->getMessage());
				$session->setItemData($data);
				return $this->_redirectReferer();
			}
		}
	}
}