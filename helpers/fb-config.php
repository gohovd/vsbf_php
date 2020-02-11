<?php

if (session_id() == "") {
    session_start();
}

$autoload_path = "";
if (file_exists("lib/Facebook/autoload.php")) {
    $autoload_path = "lib/Facebook/autoload.php";
} else if (file_exists("../lib/Facebook/autoload.php")) {
    $autoload_path = "../lib/Facebook/autoload.php";
}

require_once $autoload_path;

$FB = new \Facebook\Facebook([
    'app_id' => '534111730522683',
    'app_secret' => '6ee03b84cfe4658e7e9c2fe9fc689137',
    'default_graph_version' => 'v2.10'
]);

$helper = $FB->getRedirectLoginHelper();

?>