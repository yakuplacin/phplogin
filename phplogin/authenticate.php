<?php
session_start();	
$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

//Using information above, try to connect
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if ( mysqli_connect_errno() ) {
	// If there is an error while connecting, stop and display error
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, and we will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// may not get the information that should be sent.
	exit('Please fill both the username and password fields!');
}

// Preparing our SQL codes
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		// Account already exists, so we can verify the password.
		if (password_verify($_POST['password'], $password)) {
			// User now logged in.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			$_SESSION['id'] = $id;
			header('Location: home.php');
		} else {
			// Password is wrong
			echo 'Incorrect username and/or password!';
		}
	} else {
		// username is wrong
		echo 'Incorrect username and/or password!';
	}

	$stmt->close();
}
?>
