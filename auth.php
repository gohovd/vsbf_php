<?php

include('./helpers/debug.php');

require('config.php');

if (session_id() == "") {
	session_start();
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	die ('Please fill both the username and password field!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, digest FROM users WHERE name = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
}

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	// if (password_verify($_POST['password'], $password)) {
    if ($_POST['password'] === $password) { // without encryption i.e. digest
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		debug_to_console($_SESSION['name'] . " just logged in, so loggedin is now " . $_SESSION['loggedin']);
        // echo 'Welcome ' . $_SESSION['name'] . '!';
        header("Location: cms"); // redirect to content management system page
	} else {
		echo 'Incorrect password!';
	}
} else {
	echo 'Incorrect username!';
}
$stmt->close();
?>