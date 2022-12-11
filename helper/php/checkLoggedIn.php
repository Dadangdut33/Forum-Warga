<?php

// check logged in or not
if (!isset($_SESSION['username'])) {
  header("Location: /403.php");
}