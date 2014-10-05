<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/30/14
 * Time: 2:40 PM
 */
$this->startSetup();

$tableName = $this->getTable('sm_productLabel/label');

// Create table SM Label
$result = $this->run("
	DROP TABLE IF EXISTS `{$tableName}`;

	CREATE TABLE `{$tableName}` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`name` VARCHAR(128) NOT NULL UNIQUE,
		`position` VARCHAR(128) NOT NULL,
		`filename` TEXT NOT NULL
	);
");

// Create Label attribute group for product
$this->addAttributeGroup(
	'catalog_product',
	'default',
	'Product Label',
	1
);

// Create Label attribute for product
$this->addAttribute(
	'catalog_product',
	'sm_productlabel_label_id',
	array(
		'group'             => 'Product Label',
		'type'              => 'int',
		'backend'           => '',
		'frontend'          => '',
		'label'             => 'Product Label',
		'input'             => 'select',
		'source'            => 'sm_productLabel/source_label',
		'class'             => '',
		'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
		'visible'           => true,
		'visible_on_front'  => false,
		'required'          => false,
		'user_defined'      => false,
		'default'           => SM_ProductLabel_Model_Source_Label::NONE_VALUE,
		'searchable'        => true,
		'filterable'        => true,
		'comparable'        => true,
		'unique'            => false,
		'apply_to'          => '',
		'is_configurable'   => true
	)
);

$this->endSetup();