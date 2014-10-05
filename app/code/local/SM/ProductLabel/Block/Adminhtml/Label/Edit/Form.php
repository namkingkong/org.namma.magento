<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/1/14
 * Time: 5:36 PM
 */
class SM_ProductLabel_Block_Adminhtml_Label_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

	public function __construct() {
		parent::__construct();

		$this->setId('sm_productLabel_label_form');
		$this->setTitle($this->__('Product Label Information'));
	}

	protected function _prepareForm() {
		$label = Mage::registry('sm_productLabel_label');

		$isNew = empty($label->getId());

		$form = new Varien_Data_Form(array(
			'id'        => 'edit_form',
			'name'      => 'sm_productLabel_label_form',
			'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method'    => 'POST',
			'enctype'   => 'multipart/form-data'
		));

		$fieldset = $form->addFieldset('base_fieldset', array(
			'legend'    => $this->__('Product Label Information')
		));

		if (! $isNew) {
			$fieldset->addField('id', 'hidden', array('name' => 'id'));
		}

		$fieldset->addField('name', 'text', array(
			'name'      => 'name',
			'label'     => $this->__('Product Label Name'),
			'title'     => $this->__('Product Label Name'),
			'required'  => true
		));

		$fieldset->addField('position', 'select', array(
			'name'      => 'position',
			'label'     => $this->__('Label Position'),
			'title'     => $this->__('Label Position'),
			'required'  => true,
			'values'    => Mage::getSingleton('sm_productLabel/source_labelPosition')->getAllOptions()
		));

		$imageField = $fieldset->addField('image', 'file', array(
			'name'      => 'image',
			'label'     => $isNew ? $this->__('Label Image') : $this->__('Update New Label Image'),
			'title'     => $isNew ? $this->__('Label Image') : $this->__('Update New Label Image'),
			'required'  => $isNew ? true : false
		));

		// If this is an existed label, show it's image
		if (!$isNew) {
			$fieldset->addType('thumbnail', 'SM_ProductLabel_Block_Adminhtml_Label_Edit_Element_Thumbnail');
			$fieldset->addField('thumbnail', 'thumbnail', array(
				'label' => $this->__('Current Image'),
				'title' => $this->__('Current Image')
			));
		}

		$form->setValues($label->getData());
		$form->setUseContainer(true);

		$this->setForm($form);

		return parent::_prepareForm();
	}

}