<?php include('./debug.php'); ?>

<?php require('../config.php'); ?>

<?php

if (session_id() == "") {
	session_start();
}

if (isset($_SESSION)) {
    if ( isset($_POST['content']) && isset($_POST['title']) ) {

        // TODO: Text processing. Line changes, etc.. Bold, italic.
        $val = $_POST['content'];
        $a = date("Y-m-d H:i:s");
        $title = $_POST['title'];
        // Todo: File upload

        $sql = "INSERT INTO news(title, author, content, date, updated)
        VALUES ('" . $title . "', '" . $_SESSION['name'] . "','" . $val . "','" . $a . "', NULL)";

        if($con -> query($sql) === TRUE) {
            header("Location: /php_web_project/tutorial/");
        } else {
            error_log($con->error);
            debug_to_console($con->error);
            // header("Location: /php_web_project/tutorial/");
        }
    }
} else {
    debug_to_console("Session is not set");
}

?>