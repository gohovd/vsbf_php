<?php
if (session_id() == "") {
    session_start();
}

require('./config.php'); 

if (isset($_SESSION)) {
    if (isset($_POST['content']) && isset($_POST['title'])) {

        // TODO: Text processing. Line changes, etc.. Bold, italic.
        $content =  mysqli_real_escape_string($con, $_POST['content']);
        $updated = date('Y-m-d H:i:s');
        $title =  mysqli_real_escape_string($con, $_POST['title']);
        $id = mysqli_real_escape_string($con, $_POST['id']);

        $sql = "UPDATE news SET title='" . $title . "', content='" . $content . "', updated='" . $updated . "' WHERE ID='" . $id . "'";

        if ($con->query($sql) === TRUE) {
            error_log("Successfully updated post.");
        } else {
            error_log($con->error);
        }
    }
} else {
    error_log("Session is not set");
}
header("Location: " . $baseUrl . "/index.php");

?>