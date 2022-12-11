<?php


// must get username, if no get then 404
if (!isset($_GET['username'])) {
  header("Location: /404.php");
} else {
  $username = $_GET['username'];
}


// session
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/checkAdmin.php';

// query for the user detail
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

// echo error
if (!$result) {
  echo mysqli_error($conn);
}

$result = mysqli_fetch_assoc($result);
$email = $result['email'];
$isAdmin = $result['isAdmin'];

// check for POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get the data
  $username = $_POST['username'];
  $email = $_POST['email'];
  $isAdmin = $_POST['isAdmin'];

  // sanitize input
  $username = strip_tags($username);
  $email = strip_tags($email);
  $isAdmin = strip_tags($isAdmin);

  $username = mysqli_real_escape_string($conn, $username);
  $email = mysqli_real_escape_string($conn, $email);
  $isAdmin = mysqli_real_escape_string($conn, $isAdmin);

  // update the user
  $sql = "UPDATE users SET email = '$email', isAdmin = '$isAdmin' WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);

  // check result, if error print error
  if (!$result) {
    $error = 'Error: ' . mysqli_error($conn);
    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
  } else {
    // redirect to admin menu
    header("Location: /admin/user");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="/index.css">
  <link rel="icon" href="/favicon.ico">
  <title>Edit User</title>
</head>

<body>
  <main class="center-vertical-horizontal">
    <div class="container">
      <div class="row bg-white">
        <div class="panel panel-default" style="padding: 12px;">
          <div class="panel-heading">
            <a href="./" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left"></i> Go back to User Management Menu
            </a>
            <div class="text-center">
              <h3>Edit User</h3>
            </div>
          </div>
          <div class="panel-body">
            <form action="" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>"
                  readonly>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
              </div>
              <div class="mb-3">
                <label for="isAdmin" class="form-label">Is Admin</label>
                <select class="form-select" id="isAdmin" name="isAdmin">
                  <option value="0" <?php if ($isAdmin == 0) echo 'selected'; ?>>No</option>
                  <option value="1" <?php if ($isAdmin == 1) echo 'selected'; ?>>Yes</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>