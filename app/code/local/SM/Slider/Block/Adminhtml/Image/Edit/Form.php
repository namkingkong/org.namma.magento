<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/12/14
 * Time: 11:37 AM
 */
class SM_Slider_Block_Adminhtml_Image_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

	public function __construct() {
		parent::__construct();

		$this->setId('sm_slider_image_form');
		$this->setTitle($this->__('Image Form'));
	}

	protected function _prepareForm() {
		$model = Mage::registry('sm_slider_image');

		$form = new Varien_Data_Form(array(
			'id'    => 'sm_slider_image_form',
			'action'=> $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method'=> 'POST'
		));

		$fieldset = $form->addFieldset(
			'base_fieldset',
			array(
				'legend'    => $this->__('Image Information'),
				'class'     => 'fieldset-wide'
			)
		);

		if ($model->getId()) {
			$fieldset->addField('id', 'hidden', array('name' => 'id'));
		}

		$fieldset->addField('image', 'file', array(
			'name'      => 'image',
			'label'     => $this->__('Image'),
			'title'     => $this->__('Image'),
			'required'  => true
		));

		$fieldset->addField('title', 'text', array(
			'name'      => 'title',
			'label'     => $this->__('Title'),
			'title'     => $this->__('Title'),
			'required'  => false
		));

		$fieldset->addField('content', 'editor', array(
			'name'      => 'content',
			'label'     => $this->__('Content'),
			'title'     => $this->__('Content'),
			'required'  => false,
			'wysiwyg'   => true,
			'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
			'style'     => 'resize: vertical;'
		));

		$fieldset->addField('is_active', 'checkbox', array(
			'name'      => 'is_active',
			'label'     => 'Is Active',
			'title'     => 'Is Active',
			'required'  => false,
			'onclick'   => 'this.value = this.checked ? 1 : 0;',
			'checked'   => 'checked'
		));

		$form->setValues($model->getData());
		$form->setUseContainer(true);

		$this->setForm($form);

		return parent::_prepareForm();
	}

}
