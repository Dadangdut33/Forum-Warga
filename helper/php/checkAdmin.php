<?php

// check isAdmin or not
if (!isset($_SESSION['isAdmin'])) {
	header("Location: /403.php");
} else {
	if ($_SESSION['isAdmin'] == 0) {
		header("Location: /403.php");
	}
}