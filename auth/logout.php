<!DOCTYPE html>
<html lang="en">

<?php
// session
session_start();

// check logged in or not, if yes then log out the user
if (isset($_SESSION['username'])) {
	// destroy session
	session_destroy();

	// redirect to main page
	header('Location: /');
} else {
	// if not logged in, then redirect to login page
	header('location: login.php');
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/favicon.ico">
  <title>Logout</title>
</head>

<body>
</body>

</html>