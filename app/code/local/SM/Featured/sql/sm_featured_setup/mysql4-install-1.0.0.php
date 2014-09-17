<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/16/14
 * Time: 3:17 PM
 */
$this->startSetup();

$this->addAttributeGroup(
	'catalog_product',
	'default',
	'Featured Product Configuration',
	1
);

$this->addAttribute(
	'catalog_product',
	'is_featured',
	array(
		'group'             => 'Featured Product Configuration',
		'type'              => 'int',
		'backend'           => '',
		'frontend'          => '',
		'label'             => 'Is Featured Product',
		'input'             => 'select',
		'source'            => 'eav/entity_attribute_source_boolean',
		'class'             => '',
		'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
		'visible'           => true,
		'visible_on_front'  => false,
		'required'          => false,
		'user_defined'      => false,
		'default'           => 0,
		'searchable'        => true,
		'filterable'        => true,
		'comparable'        => true,
		'unique'            => false,
		'apply_to'          => '',
		'is_configurable'   => true
	)
);

$this->addAttribute(
	'catalog_product',
	'featured_place',
	array(
		'group'             => 'Featured Product Configuration',
		'type'              => 'int',
		'backend'           => '',
		'frontend'          => '',
		'label'             => 'Is Shown on',
		'input'             => 'select',
		'source'            => 'sm_featured/source_featuredPlace',
		'class'             => '',
		'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
		'visible'           => true,
		'visible_on_front'  => false,
		'required'          => false,
		'user_defined'      => false,
		'default'           => SM_Featured_Model_Source_FeaturedPlace::BOTH_VALUE,
		'searchable'        => true,
		'filterable'        => true,
		'comparable'        => true,
		'unique'            => false,
		'apply_to'          => '',
		'is_configurable'   => true
	)
);

$this->endSetup();
