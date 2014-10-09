<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 3:27 AM
 */
class SM_MegaMenu2_Block_Adminhtml_Item_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	public function __construct()
	{
		parent::__construct();

		$this->setId('sm_megamenu2_item_form');
		$this->setTitle($this->__('Mega Menu Item Configuration'));
	}

	protected function _prepareForm()
	{
		$item = Mage::registry('sm_megamenu2_item');

		$isNew = empty($item->getId());

		$form = new Varien_Data_Form(array(
			'id'        => 'edit_form',
			'name'      => 'sm_megamenu2_item_form',
			'action'    => $this->getUrl('*/*/save', array('id' => $item->getId())),
			'method'    => 'POST'
		));

		$fieldset = $form->addFieldset('base_fieldset', array(
			'legend'    => $this->__('Menu Item Configuration')
		));

		if (! $isNew) {
			$fieldset->addField('id', 'hidden', array('name' => 'id'));
		}

		$fieldset->addField('label', 'text', array(
			'name'      => 'label',
			'label'     => $this->__('Menu Label'),
			'title'     => $this->__('Menu Label'),
			'required'  => true
		));

		$fieldset->addField('item_type', 'select', array(
			'name'      => 'item_type',
			'label'     => $this->__('Item Type'),
			'title'     => $this->__('Item Type'),
			'required'  => true,
			'options'   => Mage::getSingleton('sm_megamenu2/source_itemType')->getOptionsArray()
		));

		$fieldset->addField('category_id', 'select', array(
			'name'      => 'category_id',
			'label'     => $this->__('Category'),
			'title'     => $this->__('Category'),
			'options'   => Mage::getSingleton('sm_megamenu2/source_categoryList')->getOptionsArray()
		));

		$fieldset->addField('block_id', 'select', array(
			'name'      => 'block_id',
			'label'     => $this->__('Block'),
			'title'     => $this->__('Block'),
			'options'   => Mage::getSingleton('sm_megamenu2/source_blockList')->getOptionsArray()
		));

		$fieldset->addField('link', 'text', array(
			'name'      => 'link',
			'label'     => $this->__('Link'),
			'title'     => $this->__('Link')
		));

		$form->setValues($item->getData());
		$form->setUseContainer(true);

		$this->setForm($form);

		return parent::_prepareForm();
	}
}