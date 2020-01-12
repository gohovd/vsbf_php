<?php require('config.php'); ?>

<?php

$database_name = 'vikesbf';
$sql_check_if_exists = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $database_name . "'";

$sql_create_database = "CREATE DATABASE IF NOT EXISTS vikesbf";

$sql_create_users_table = "CREATE TABLE IF NOT EXISTS `vikesbf`.`users` (
    `id` INT(255) NOT NULL AUTO_INCREMENT ,
    `username` VARCHAR(120) NOT NULL ,
    `phone` INT(24) NULL , `email` VARCHAR(120) NULL ,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated` DATETIME NULL , `password` VARCHAR(255) NOT NULL ,
    `activation_code` VARCHAR(50) DEFAULT '',
    INDEX (username),
    PRIMARY KEY (`id`)) ENGINE = MyISAM;";

$sql_create_news_table = "CREATE TABLE IF NOT EXISTS `vikesbf`.`news` (
    `id` INT(255) NOT NULL AUTO_INCREMENT ,
    `author` VARCHAR(120) NULL ,
    `title` VARCHAR(60) NOT NULL,
    `content` TEXT NOT NULL ,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated` DATETIME NULL ,
    INDEX (author),
    PRIMARY KEY (`id`)) ENGINE = MyISAM;";

if ($con->query($sql_check_if_exists) === TRUE) {
    error_log("Did not find database to exists. Creating it now..");
    // create database vikesbf
    if ($con->query($sql_create_database) === TRUE) {
        error_log("Database vikesbf successfully created.");
    } else {
        error_log("Error creating database: " . mysqli_error($con));
    }

    // select the relevant database
    $con->select_db("vikesbf");

    // create table users
    if ($con->query($sql_create_users_table) === TRUE) {
        error_log('Table users successfully created');
    } else {
        error_log('Error creating table users: ' . mysqli_error($con));
    }

    // create table news
    if ($con->query($sql_create_news_table) === TRUE) {
        error_log('Table news successfully created');
    } else {
        error_log('Error creating table news: ' . mysqli_error($con));
    }

} else {
    // nothing... database exists...
}

?>