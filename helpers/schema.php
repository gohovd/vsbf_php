<?php require('config.php'); ?>

<?php

$DB_NAME = 'vikesbf';

$SQL_CREATE_USERS = "CREATE TABLE IF NOT EXISTS `vikesbf`.`users` (
    `id` INT(255) NOT NULL AUTO_INCREMENT ,
    `username` VARCHAR(120) NOT NULL ,
    `phone` INT(24) NULL , `email` VARCHAR(120) NULL ,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated` DATETIME NULL , `password` VARCHAR(255) NOT NULL ,
    `activation_code` VARCHAR(50) DEFAULT '',
    `formann` INT(4) NULL DEFAULT 0,
    INDEX (username),
    PRIMARY KEY (`id`)) ENGINE = MyISAM;";

$SQL_CREATE_NEWS = "CREATE TABLE IF NOT EXISTS `vikesbf`.`news` (
    `id` INT(255) NOT NULL AUTO_INCREMENT ,
    `author` VARCHAR(120) NULL ,
    `title` VARCHAR(60) NOT NULL,
    `content` TEXT NOT NULL ,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated` DATETIME NULL ,
    INDEX (author),
    PRIMARY KEY (`id`)) ENGINE = MyISAM;";

if ($con->select_db($DB_NAME)) {
    error_log("Selected " . $DB_NAME . " database \n");
} else {
    error_log("Failed to select db: " . mysqli_connect_error() . "\n");
    die();
}

if ($con->query($SQL_CREATE_USERS)) {
    error_log("Table 'Users' successfully created. \n");
} else {
    error_log("Failed to create 'Users' table: " . mysqli_connect_error() . "\n");
    die();
}

if ($con->query($SQL_CREATE_NEWS)) {
    error_log("Table 'News' successfully created. \n");
} else {
    error_log("Failed to create 'News' table: " . mysqli_connect_error() . "\n");
    die();
}

?>