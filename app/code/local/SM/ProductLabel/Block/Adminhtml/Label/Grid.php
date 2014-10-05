<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/1/14
 * Time: 3:55 PM
 */
class SM_ProductLabel_Block_Adminhtml_Label_Grid extends Mage_Adminhtml_Block_Widget_Grid {

	public function __construct() {
		parent::__construct();
		$this->setDefaultSort('name');
		$this->setId('sm_productLabel_label_grid');
		$this->setDefaultDir('asc');
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection() {
		$this->setCollection(Mage::getModel('sm_productLabel/label')->getCollection());
		parent::_prepareCollection();
	}

	protected function _prepareMassaction() {
		parent::_prepareMassaction();

		$this->setMassactionIdField('id');

		$this->getMassactionBlock()
			->setFormFieldName('id')
			->addItem('remove', array(
				'label'     => $this->__('Remove'),
				'url'       => $this->getUrl('*/*/massDelete'),
				'confirm'   => $this->__('Delete Selected Label?')
			));
	}

	protected function _prepareColumns() {
		$this->addColumn(
			'sm_productLabel_id',
			array(
				'index'     => 'name',
				'header'    => $this->__('Label Name')
			)
		);

		$this->addColumn(
			'sm_productLabel_position',
			array(
				'index'     => 'position',
				'header'    => $this->__('Position')
			)
		);

		$this->addColumn(
			'sm_productLabel_image',
			array(
				'header'    => $this->__('Label Image'),
				'renderer'  => 'SM_ProductLabel_Block_Adminhtml_Label_Grid_Renderer_Thumbnail',
				'align'     => 'center'
			)
		);

		parent::_prepareColumns();
	}

	public function getRowUrl($obj) {
		return $this->getUrl('*/*/edit', array('id' => $obj->getId()));
	}

}