<?php require('./config.php'); ?>

<?php

if (session_id() == "") {
    session_start();
}

if (isset($_SESSION)) {
    if (isset($_POST['content']) && isset($_POST['title'])) {

        // TODO: Text processing. Line changes, etc.. Bold, italic.
        $content =  mysqli_real_escape_string($con, $_POST['content']);
        $a = date('Y-m-d H:i:s');
        $title =  mysqli_real_escape_string($con, $_POST['title']);
        // Todo: File upload

        // Retrieve full name of author
        $query = "SELECT first, last FROM users WHERE username='" . $_SESSION['username'] . "'";
        if ($result = $con -> query($query)) {
            // nothing..
        } else {
            error_log("Did not find the specified user: " . $con->error);
        }

        while($result_ar = mysqli_fetch_assoc($result)) {
            $first = ucfirst($result_ar['first']);
            $last = ucfirst($result_ar['last']);
        }

        $sql = "INSERT INTO news(title, author, content, date, updated)
            VALUES ('" . $title . "', '" . $first . "','" . $content . "',now(), NULL)";

        if ($con->query($sql) === TRUE) {
            // nothing...
        } else {
            error_log($con->error);
        }
    }
} else {
    error_log("Session is not set");
}
header("Location: /php_web_project/tutorial/");

?>