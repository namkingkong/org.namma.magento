<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/10/14
 * Time: 4:07 PM
 */
class SM_Slider_Block_Adminhtml_Slider_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

	public function __construct() {
		parent::__construct();

		$this->setId('sm_slider_slider_form');
		$this->setTitle($this->__('Slider Information'));
	}

	/**
	 * Define how the form appear
	 *
	 * @return Mage_Adminhtml_Block_Widget_Form|void
	 */
	protected function _prepareForm() {
		$model = Mage::registry('sm_slider_slider');

		$form = new Varien_Data_Form(array(
//			'id'        => 'sm_slider_slider_form',
			'id'        => 'edit_form',
			'action'    => $this->getUrl('*/*/save', array('id', $this->getRequest()->getParam('id'))),
			'method'    => 'POST'
		));

		$fieldset = $form->addFieldset(
			'base_field_set',
			array(
				'legend'    => Mage::helper('sm_slider')->__('Slider Information'),
				'class'     => 'fieldset-wide'
			)
		);

		// Check if this model instance is new or an existed one
		if ($model->getId()) {
			$fieldset->addField('id', 'hidden', array('name' => 'id'));
		}

		$fieldset->addField('name', 'text', array(
			'name'      => 'name',
			'label'     => Mage::helper('sm_slider')->__('Name'),
			'title'     => Mage::helper('sm_slider')->__('Name'),
			'required'  => true
		));

		$fieldset->addField('is_active', 'checkbox', array(
			'name'      => 'is_active',
			'label'     => 'Is Active',
			'title'     => 'Is Active',
			'required'  => false,
			'onclick'   => 'this.value = this.checked ? 1 : 0;',
			'checked'   => true
		));

		$form->setValues($model->getData());
		$form->setUseContainer(true);

		$this->setForm($form);

		return parent::_prepareForm();
	}
}
