<?php
//We should start sessions using the below code.
session_start();

// If user is not logged in, go log in page
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
//This is for taking the information
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


if ( mysqli_connect_errno() ) {
	// If there is an error while connecting, stop and display the error
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
//Above, after taking information, we can take all accounts from accounts table so that we can show it on the page! It is below under html codes with foreach codes!
$users = mysqli_query($con,'SELECT * FROM accounts');

$con->close();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page of Assignment3!</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>ASSIGNMENT 3, WELCOME!</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page of Assignment3!</h2>
			<p>It is Assignment3, welcome <?=$_SESSION['name']?>!</p>
			<p>Here, information of all accounts:</p>
			<table>
    <?php foreach($users as $user){ ?>  
    <tr>
        <td><?php echo $user['username'];  ?></td>
		
        <td><?php echo $user['email'];  ?></td>
		
        <td><?php echo $user['password'];  ?></td>
    </tr>
    <?php } ?>
</table>
		</div>
	</body>
</html>


