<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/9/14
 * Time: 3:38 PM
 */
$this->startSetup();

$sliderTableName = $this->getTable('sm_slider/slider');
$imageTableName = $this->getTable('sm_slider/image');

$this->run("
	DROP TABLE IF EXISTS `{$imageTableName}`;
	DROP TABLE IF EXISTS `{$sliderTableName}`;

	CREATE TABLE `{$sliderTableName}` (
		`id`		INT				NOT NULL AUTO_INCREMENT,
		`name`		VARCHAR(128)	NOT NULL,
		`type`		VARCHAR(32)	NOT NULL,
		`is_active`	BOOLEAN 		NOT NULL DEFAULT TRUE,
		PRIMARY KEY (`id`)
	);

	CREATE TABLE `{$imageTableName}` (
		`id`		INT		NOT NULL AUTO_INCREMENT,
		`filename`	TEXT	NOT NULL,
		`title`		TEXT	NOT NULL,
		`content`	TEXT	NOT NULL,
		`slider_id`	INT		NOT NULL,
		`is_active`	BOOLEAN NOT NULL DEFAULT TRUE,
		PRIMARY KEY (`id`),
		FOREIGN KEY (`slider_id`)
			REFERENCES `{$sliderTableName}`(`id`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
	);
");

$this->endSetup();
