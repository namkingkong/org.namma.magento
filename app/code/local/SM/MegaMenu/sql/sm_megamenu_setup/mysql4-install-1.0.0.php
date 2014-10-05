<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/8/14
 * Time: 9:32 AM
 */
$this->startSetup();

$tableName = $this->getTable('sm_megamenu/item');

$result = $this->run("
	DROP TABLE IF EXISTS `{$tableName}`;
	CREATE TABLE `{$tableName}` (
		`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
		`name` VARCHAR(128) NOT NULL,
		`block_id` SMALLINT NOT NULL,
		`store_id` SMALLINT UNSIGNED NOT NULL,
		`order` INT,
		`is_active` BOOLEAN NOT NULL DEFAULT TRUE
	);
	ALTER TABLE `{$tableName}` ADD FOREIGN KEY (`block_id`) REFERENCES `cms_block`(`block_id`);
	ALTER TABLE `{$tableName}` ADD FOREIGN KEY (`store_id`) REFERENCES `core_store`(`store_id`);
");

$this->endSetup();
