<?php

include('./debug.php');

require('./config.php');

if (session_id() == "") {
	session_start();
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	die ('Please fill both the username and password field!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
}

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();

	if (password_verify($_POST['password'], $password)) {
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['id'] = $id;
        $_SESSION['message'] = 'Vellykket innlogging.';
		header("Location: /php_web_project/tutorial/");
	} else {
		echo 'Incorrect password!';
	}
} else {
	echo 'Incorrect username!';
}

?>