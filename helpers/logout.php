<?php
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'logout':
            $_SESSION['loggedin'] = false;
            session_start();
            session_destroy();
            break;
    }
}
?>