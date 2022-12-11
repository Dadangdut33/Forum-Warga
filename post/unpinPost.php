<?php

session_start();
// get post post id
$post_id = $_POST['id'];

// update post_id to pinned
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/checkAdmin.php';
$sql = "UPDATE post SET pinned = 0 WHERE id = $post_id";
$result = mysqli_query($conn, $sql);

// check result, if error print error
if (!$result) {
  $error = 'Error: ' . mysqli_error($conn);
  echo $error;
} else {
  echo 'success';
}