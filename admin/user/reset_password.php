<?php

// session
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/checkAdmin.php';

// POST request to reset password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get the data
  $id = $_POST['id'];
  $password = $_POST['password'];

  // sanitize
  $id = strip_tags($id);
  $id = mysqli_real_escape_string($conn, $id);
  $password = strip_tags($password);
  $password = mysqli_real_escape_string($conn, $password);

  // hash the password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // update the password
  $sql = "UPDATE users SET password = '$password' WHERE username = '$id'";
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