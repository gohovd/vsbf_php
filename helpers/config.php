<?php

$baseUrl = "/vsbf_php";

$user = 'root';
$host = '127.0.0.1';
$pass = 'root';
$db = 'vikesbf';
$port = 8889;

$con = mysqli_connect($host, $user, $pass, $db, $port);

$con->set_charset("utf-8");

if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>
