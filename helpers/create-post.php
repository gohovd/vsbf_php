<?php 
if (session_id() == "") {
    session_start();
}

require('./config.php');

if (isset($_SESSION)) {
    if (isset($_POST['content']) && isset($_POST['title'])) {

        // TODO: Text processing. Line changes, etc.. Bold, italic.
        $content =  mysqli_real_escape_string($con, $_POST['content']);
        $title =  mysqli_real_escape_string($con, $_POST['title']);
        $a = date('Y-m-d H:i:s');

        // Todo: File upload

        $sql = "INSERT INTO news(title, author, content, date, updated)
            VALUES ('" . $title . "', '" . ucfirst($_SESSION['username']) . "','" . $content . "',now(), NULL)";

        if ($con->query($sql) === TRUE) {
            // nothing...
        } else {
            error_log($con->error);
        }
        
    }
} else {
    error_log("Session is not set");
}
header("Location: " . $baseUrl . "/index.php");

?>