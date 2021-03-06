<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/11/14
 * Time: 5:11 PM
 */
class SM_Slider_Block_Adminhtml_Image_Grid extends Mage_Adminhtml_Block_Widget_Grid {

	public function __construct() {
		parent::__construct();

		$this->setId('id')
			->setDefaultSort('id')
			->setDefaultDir('asc')
			->setSaveParametersInSession(true);
	}

	protected function _prepareCollection() {
		$this->setCollection(
			Mage::getModel('sm_slider/image')
				->getCollection()
				->addFieldToFilter('slider_id', $this->getParam('id'))
		);

		parent::_prepareCollection();
	}

	protected function _prepareMassaction() {
		parent::_prepareMassaction();

		$this->setMassactionIdField('id');

		$this->getMassactionBlock()
			->addItem('remove', array(
				'label' => $this->__('Remove Selected Images'),
				'url'   => $this->getUrl('*/sm_sliderImage/massDelete')
			));

		$this->getMassactionBlock()
			->addItem('enable', array(
				'label' => $this->__('Enable'),
				'url'   => $this->getUrl('*/sm_sliderImage/massEnable')
			));

		$this->getMassactionBlock()
			->addItem('disable', array(
				'label' => $this->__('Disable'),
				'url'   => $this->getUrl('*/sm_sliderImage/massDisable')
			));

		return $this;
	}

	protected function _prepareColumns() {
		$this->addColumn(
			'sm_slider_image_img',
			array(
				'header'    => $this->__('Thumbnail'),
				'index'     => 'filename',
				'renderer'  => new SM_Slider_Block_Adminhtml_Image_Thumbnail(),
				'width'     => '25%'
			)
		);

		$this->addColumn(
			'sm_slider_image_title',
			array(
				'header'    => $this->__('Image Title'),
				'index'     => 'title',
			)
		);

		$this->addColumn(
			'sm_slider_image_content',
			array(
				'header'    => $this->__('Image Content'),
				'index'     => 'content'
			)
		);

		$this->addColumn(
			'sm_slider_image_is_active',
			array(
				'header'    => 'Is Active',
				'index'     => 'is_active',
				'type'      => 'options',
				'options'   => array(
					1 => 'Yes',
					0 => 'No'
				)
			)
		);

		parent::_prepareColumns();
	}

	public function getRowUrl($row) {
		return $this->getUrl('*/sm_sliderImage/edit', array('id' => $row->getId()));
	}
}
