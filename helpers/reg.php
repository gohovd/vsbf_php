<?php

require('./config.php');

if (session_id() == "") {
	session_start();
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	error_log('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	error_log('Please complete the registration form');
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		error_log('Username exists, please choose another!');
	} else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            error_log('Email is not valid!');
        }
        if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
            error_log('Username is not valid!');
        }
        if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            error_log('Password must be between 5 and 20 characters long!');
        }
		// Username doesnt exists, insert new account
        // if ($stmt = $con->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {
        if ($stmt = $con->prepare('INSERT INTO users (username, password, email, activation_code) VALUES (?, ?, ?, ?)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $uniqid = uniqid();
            $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $uniqid);
            $stmt->execute();
            // error_log('You have successfully registered, you can now login!');
            $from    = 'noreply@vikesbf.no';
            $subject = 'Aktiver Konto ved vikesbf.no';
            $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
            $activate_link = 'http://vikesbf.no/helpers/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
            $message = '<p>Følg denne linken for å aktivere konto: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
            mail($_POST['email'], $subject, $message, $headers);
            echo 'Please check your email to activate your account!';
            $_SESSION['message'] = 'Vellykket registrering, du kan nå logge inn!';
            header("Location: /php_web_project/tutorial/login.php");
            $stmt->close();
        } else {
            // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
            error_log("Failed to create new user!".$con->error);
        }
	}
	
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	error_log("Failed to prepare statement!".$con->error);
}
$con->close();
