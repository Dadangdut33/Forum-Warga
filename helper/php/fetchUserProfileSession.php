<?php

$user = $_SESSION['username'];

// sanitize $user
$user = strip_tags($user);
$user = mysqli_real_escape_string($conn, $user);

// check if it exist in db or not
$sql = "SELECT * FROM Users WHERE username = '" . $user . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	// if it exist, get the data
	$row = mysqli_fetch_assoc($result);
	$username = $row['username'];
	$email = $row['email'];
	$bio = $row['bio'] ? $row['bio'] : 'No biography set';
} else {
	header("Location: /404.php");
}