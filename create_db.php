<?php require('./config.php'); ?>

<?php

$sql_create_database = "CREATE DATABASE IF NOT EXISTS vikesbf";

$sql_create_users_table = "CREATE TABLE IF NOT EXISTS `vikesbf`.`users` (
    `id` INT(255) NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(120) NOT NULL ,
    `phone` INT(24) NULL , `email` VARCHAR(120) NULL ,
    `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated` DATE NULL , `digest` VARCHAR(255) NOT NULL ,
    PRIMARY KEY (`id`)) ENGINE = MyISAM;";

$sql_create_news_table = "CREATE TABLE IF NOT EXISTS `vikesbf`.`news` (
    `id` INT(255) NOT NULL AUTO_INCREMENT ,`author` VARCHAR(120) NULL ,
    `content` TEXT NOT NULL , `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated` DATE NULL ,
    PRIMARY KEY (`id`)) ENGINE = MyISAM;";

// create database vikesbf
if ($con->query($sql_create_database) === TRUE) {
    error_log("Database vikesbf successfully created.");
}else {
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

$con->close();

?>