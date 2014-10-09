<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/6/14
 * Time: 11:29 PM
 */
$conn = &$this;

$conn->startSetup();

$itemTableName = $conn->getTable('sm_megamenu2/item');

$conn->run("
	DROP TABLE IF EXISTS `{$itemTableName}`;

	CREATE TABLE `{$itemTableName}`
	(
		`id`			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`label`			VARCHAR(128) NOT NULL UNIQUE,
		`item_type`		INT NOT NULL,
		`category_id`	INT
						REFERENCES `catalog_category_entity`(`entity_id`)
						ON UPDATE CASCADE
						ON DELETE SET NULL,
		`block_id`		INT
						REFERENCES `cms_block`(`block_id`)
						ON UPDATE CASCADE
						ON DELETE SET NULL,
		`link`			TEXT
	);
");

$conn->endSetup();