<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/25/14
 * Time: 11:27 AM
 */
$this->startSetup();

$this->getConnection()->addColumn(
	$this->getTable('catalog/eav_attribute'),
	'filter_display_type',
	array(
		'type'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
		'nullable'  => true,
		'comment'   => 'This is how the filter will be displayed'
	)
);

$this->endSetup();