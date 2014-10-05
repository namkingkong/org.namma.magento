<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/1/14
 * Time: 3:33 PM
 */
class SM_ProductLabel_Adminhtml_ProductLabelController extends Mage_Adminhtml_Controller_Action {

	protected function _init() {
		$this->loadLayout()
			->_setActiveMenu('sm_module')
			->_title($this->__('Manage Product Labels'), $this->__('Manage Product Labels'))
			->_addBreadcrumb($this->__('SM Modules'), $this->__('SM Modules'))
			->_addBreadcrumb($this->__('Manage Product Labels'), $this->__('Manage Product Labels'));

		return $this;
	}

	protected function _prepareFormContainer() {
		$label = Mage::getModel('sm_productLabel/label');

		$labelId = $this->getRequest()->getParam('id');

		// If label ID is given (This would be edit page)
		if ($labelId) {
			$label = $label->load($labelId);

			// If failed to load model instance
			if (! $label->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('The requested product label is not available'));
				return $this->_redirect('*/*');
			}
		}

		$this->_title($labelId ? $this->__('Create New Product Label') : $this->__('Edit Product Label'));

		$labelFlashData = Mage::getSingleton('adminhtml/session')->getProductLabelData(true);
		if (! empty($labelFlashData)) {
			$label->setData($labelFlashData);
		}

		Mage::register('sm_productLabel_label', $label);

		$this->_init();

		$this->_addBreadcrumb(
			$labelId ? $this->__('Edit Product Label') : $this->__('Create New Product Label'),
			$labelId ? $this->__('Edit Product Label') : $this->__('Create New Product Label')
		);

		$this->_addContent(
			$this->getLayout()->createBlock(
				'sm_productLabel/adminhtml_label_edit',
				'sm_productLabel_label_edit',
				array(
					'action'    => $this->getUrl('*/*/save')
				)
			)
		);

		$this->renderLayout();
	}

	protected function _saveImage($label) {
		$image = new Mage_Core_Model_File_Uploader('image');
		$image->setAllowedExtensions(array('jpg', 'png', 'gif'));

		$destination = Mage::getBaseDir('media') . '/sm/label/';
		$fileName = $label->getId() . '.' . $image->getFileExtension();

		$image->save($destination, $fileName);

		return $fileName;
	}

	public function indexAction() {
		$this->_init()->renderLayout();
	}

	public function newAction() {
		$this->_prepareFormContainer();
	}

	public function editAction() {
		$this->_prepareFormContainer();
	}

	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {

			$session = Mage::getSingleton('adminhtml/session');

			try {
				$label = Mage::getModel('sm_productLabel/label')->setData($data)->save();

				if (is_uploaded_file($_FILES['image']['tmp_name'])) {
					$fileName = $this->_saveImage($label);
					$label->setFilename($fileName)->save();
				}

				$session->addSuccess($this->__('New Product Label Created Successfully'));

				return $this->_redirect('*/*');
			}
			catch (Exception $ex) {
				$session->addError('Exception Message: ' . $ex->getMessage());
			}

			$session->setLabelData($data);

			$this->_redirectReferer();
		}
	}

	public function deleteAction() {
		$id = $this->getRequest()->getParam('id');

		$session = Mage::getSingleton('adminhtml/session');

		if ($id) {
			$label = Mage::getModel('sm_productLabel/label')->load($id);

			if($label->getId()) {
				$label->delete();
				$session->addSuccess($this->__('Label Was Deleted Successfully'));
			}
			else {
				$session->addError($this->__('Label With The Given ID Was Not Found'));
			}
		}
		else {
			$session->addError($this->__('Label ID is Required'));
		}

		$this->_redirect('*/*');
	}

	public function massDeleteAction() {
		$ids = $_POST['id'];

		$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
		$session    = Mage::getSingleton('adminhtml/session');

		try {
			$connection->beginTransaction();

			$count = 0;

			foreach ($ids as $id) {
				$label = Mage::getModel('sm_productLabel/label')->load($id);
				$label->delete();

				++ $count;
			}

			$connection->commit();

			$session->addSuccess($this->__("Total of {$count} Product Labels Have Been Deleted"));
		}
		catch (Exception $ex) {
			$connection->rollback();
			$session->addError('Error Message: ' . $ex->getMessage());
		}

		$this->_redirect('*/*');
	}
}