<?php
$DEBUG = true;

// connect  to db
$conn = mysqli_connect('localhost', 'root', '', 'forum_sederhana');
// if not debug mode you should input the correct username and password

// check connection
if (!$conn)
	die("Connection failed: " . mysqli_connect_error());


$server_root = $_SERVER['DOCUMENT_ROOT'];