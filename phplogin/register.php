<?php
//My connection info, you can change it as yours
$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

//Using info above, try and connect DB
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// We can check if the information was submitted before, function will check if the data exists already.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {

	exit('Please complete the registration form!');
}

// Check if the submition value is empty or not.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {

	exit('Please complete the registration form');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}

if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid!');
}

if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}

// We check if the account with the same username exists or not.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Gash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Collect/store the results and we can check if the account is in the DB.
	if ($stmt->num_rows > 0) {
		// If username already exists:
		echo 'Username exists, please choose another!';
	} else {
		// If not, insert new one.
		if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
			// Hash the password and use password_verify when users are trying to login.
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
			$stmt->execute();
			echo 'You have successfully registered, you can now login!';
		} else {
			// Something went wrong, it means check again!
			echo 'Could not prepare statement!';
		}
	}
	
	$stmt->close();
	
} else {
	// Something went wrong, it means check again!
	echo 'Could not prepare statement!';
}

$con->close();

?>
