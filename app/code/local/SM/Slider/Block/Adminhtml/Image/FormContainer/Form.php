<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/12/14
 * Time: 11:37 AM
 */
class SM_Slider_Block_Adminhtml_Image_FormContainer_Form extends Mage_Adminhtml_Block_Widget_Form {

	public function __construct() {
		parent::__construct();

		$this->setId('sm_slider_image_form');
		$this->setTitle($this->__('Image Form'));
	}

	protected function _prepareForm() {
		$model = Mage::registry('sm_slider_image');

		$form = new Varien_Data_Form(array(
//			'id'    => 'sm_slider_image_form',
			'id'    => 'edit_form',
			'action'=> $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method'=> 'POST'
		));

		$fieldset = $form->addFieldset(
			'base_fieldset',
			array(
				'legend'    => $this->__('Image Information'),
				'class'     => 'fieldset_wide'
			)
		);

		if ($model->getId()) {
			$fieldset->addField('id', 'hidden', array('name' => 'id'));
		}

		$fieldset->addField('')

		$this->setForm($form);

		return parent::_prepareForm();
	}

}
