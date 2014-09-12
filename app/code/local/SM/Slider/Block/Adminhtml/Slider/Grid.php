<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/9/14
 * Time: 5:32 PM
 */
class SM_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid {

	public function __construct() {
		// Call predecessor's constructor
		parent::__construct();

		// Set some default configurations for our grid
		$this->setDefaultSort('name');
		$this->setId('sm_slider_grid');
		$this->setDefaultDir('asc');
		$this->setSaveParametersInSession(true);
	}

	/**
	 * Get and set data collection for the grid to be printed out
	 *
	 * @return Mage_Adminhtml_Block_Widget_Grid
	 */
	protected function _prepareCollection() {
		$this->setCollection(
			Mage::getModel('sm_slider/slider')->getCollection()
		);

		return parent::_prepareCollection();
	}

	protected function _prepareMassaction() {
		// Code here
	}

	/**
	 * Define the grid's columns to be shown
	 */
	protected function _prepareColumns() {
		$this->addColumn(
			'sm_slider_name',
			array(
				// Say it AGAIN, we don't need to call Helper here
				// This is what will be displayed as the table header
				'header'    => $this->__('Slider Name'),
				// This is the name of column in the database
				'index'     => 'name'
			)
		);

		$this->addColumn(
			'sm_slider_type',
			array(
				'header'    => $this->__('Slider Type'),
				'index'     => 'type'
			)
		);

		$this->addColumn(
			'sm_slider_is_active',
			array(
				'header'    => $this->__('Is Active'),
				'index'     => 'is_active',
				'type'      => 'options',
				'options'   => array(
					1 => 'Yes',
					0 => 'No'
				)
			)
		);

		return parent::_prepareColumns();
	}

	/**
	 * Generate URL for each table row
	 *
	 * @param $row
	 *
	 * @return string
	 */
	public function getRowUrl($row) {
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}
