<?php include('./helpers/debug.php'); ?>

<?php

if (isset($_POST['flavor'])) {

    switch ($_POST['flavor']) {
        case 'chocolate':
            setFlavor("chocolate");
            break;
        case 'vanilla':
            setFlavor("vanilla");
            break;
        case 'raspberry':
            setFlavor("raspberry");
            break;
        default:
            setFlavor("nothin'!");
            break;
    }
}

function setFlavor($type)
{
    setcookie("cookie-flavor", $type, time()+60*60*24*365, '/'); 
}

?>