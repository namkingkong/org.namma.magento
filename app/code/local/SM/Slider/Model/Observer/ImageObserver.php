<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/12/14
 * Time: 3:58 PM
 */
class SM_Slider_Model_Observer_ImageObserver {

	protected $_imageFile = null;

	/** @var Varien_File_Uploader  */
	protected $_uploader = null;

	protected $_isEdit = false;

	public function __construct() {
		$this->_imageFile = $_FILES['image'];

		$this->_isEdit = $isEdit = Mage::app()->getRequest()->getParam('id') !== null;

		if (! $isEdit) {
			if (! $this->_imageFile) {
				die('Image is required');
			}

			$uploader = $this->_uploader = new Varien_File_Uploader('image');
			$uploader->setAllowedExtensions(array('img', 'jpg', 'png', 'gif', 'bmp'));
			$uploader->setAllowRenameFiles(false);
			$uploader->setAllowCreateFolders(true);
		}
	}

	/**
	 * Get file name of the uploaded image, and assign to model's filename field
	 *
	 * @param $observer Varien_Event_Observer
	 */
	public function imageBeforeSave(&$observer) {
		// Get model from event
		$image = $observer->getEvent()->getObject();

		// Get uploaded file
		$file = &$this->_imageFile;

		$image->setFilename($file['name']);
	}

	/**
	 * After successfully saving the image data,
	 * Build the new image file name and save it to /media/sm/slider/{slider_id}/{image_id}_{filename}
	 *
	 * @param $observer Varien_Event_Observer
	 */
	public function imageAfterSave(&$observer) {
		if (! $this->_isEdit) {
			$image = $observer->getEvent()->getObject();

			$newFilename = "{$image->getId()}_{$image->getFilename()}";
			$dir = Mage::getBaseDir('media') . "/sm/slider/{$image->getSliderId()}";

			$this->_uploader->save($dir, $newFilename);
		}
	}

}
