<?php
if (session_id() == "") {
	session_start();
}

if (isset($_SESSION)) {
    if(isset($_POST)) {
        include('./config.php');

        if($_POST['action'] == "delete-all") {
            $sql = "DELETE FROM news";
            error_log("Deleting all posts.");

            if ($con-> query($sql) === TRUE) {
                error_log("All news were deleted.");
            } else {
                error_log($con->error);
            }
        } else if ($_POST['action'] == "delete") {
            $sql = "DELETE FROM news WHERE id = " . $_POST['post_id'];

            if ($con-> query($sql) === TRUE) {
                error_log("Post with ID = " . $_POST['post_id'] . " was deleted.");
            } else {
                error_log($con->error);
            }
        } else {
            error_log("(delete-post) unknown action: " . $_POST['action']);
        }
        
        
    }
} else {
    error_log("(delete-post) session is not set.");
}
header("Location: " . $baseUrl . "/index.php");
?>