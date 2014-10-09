<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 1:49 AM
 */
class SM_MegaMenu2_Block_Adminhtml_Item_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();

		$this->setId('sm_megamenu2_item_grid');
		$this->setDefaultSort('label');
		$this->setDefaultDir('asc');
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$this->setCollection(Mage::getModel('sm_megamenu2/item')->getCollection());

		parent::_prepareCollection();
	}

	protected function _prepareMassaction()
	{
		// Code here...
	}

	protected function _prepareColumns()
	{
		$this->addColumn('id', array(
			'index'     => 'id',
			'header'    => $this->__('ID')
		));

		$this->addColumn('label', array(
			'index'     => 'label',
			'header'    => $this->__('Item Label')
		));

		$this->addColumn('item_type', array(
			'header'    => $this->__('Item Type'),
			'renderer'  => 'SM_MegaMenu2_Block_Adminhtml_Item_Grid_Renderer_ItemType'
		));

		/*
		 * *********************************************************
		 * The 3 content fields (category, block, link) SHOULD be
		 * converted into only 1 column.
		 * The content to be shown would be controlled by a RENDERER
		 * *********************************************************
		 */
		$this->addColumn('content', array(
			'header'    => $this->__('Content'),
			'renderer'  => 'SM_MegaMenu2_Block_Adminhtml_Item_Grid_Renderer_Content'
		));

		parent::_prepareColumns();
	}

	public function getRowUrl($obj)
	{
		return $this->getUrl('*/*/edit', array(
			'id' => $obj->getId()
		));
	}
}