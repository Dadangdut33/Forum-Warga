<?php
$DEBUG = true;

// connect  to db
$conn = mysqli_connect('localhost', 'root', '', 'forum_sederhana');
// if not debug mode you should input the correct username and password

// check connection
if (!$conn)
	die("Connection failed: " . mysqli_connect_error());


$server_root = $_SERVER['DOCUMENT_ROOT'];

// query for forum name
$sql = "SELECT * FROM web_config";
$result = mysqli_query($conn, $sql);

// check result
if ($result && $result->num_rows > 0) {
	$forumName = $result->fetch_assoc()['forum_name'];
} else {
	// echo mysqli_error($conn);
	$forumName = "";
}