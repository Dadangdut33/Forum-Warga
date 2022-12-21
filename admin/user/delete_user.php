<?php

// session
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/checkAdmin.php';

// POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get the data
  $id = $_POST['id'];

  // sanitize
  $id = strip_tags($id);
  $id = mysqli_real_escape_string($conn, $id);

  // delete the user
  $sql = "DELETE FROM users WHERE username = '$id'";
  $result = mysqli_query($conn, $sql);

  // check result, if error print error
  if (!$result) {
    $error = 'Error: ' . mysqli_error($conn);
    echo $error;
  } else {
    echo 'success';
  }
} else {
  header("Location: /403.php");
}
