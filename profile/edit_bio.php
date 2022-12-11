<?php

// session
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/fetchUserProfileSession.php';

// POST request to change bio
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get the data
  $bio = $_POST['bio'];

  // sanitize
  $bio = strip_tags($bio);
  $bio = mysqli_real_escape_string($conn, $bio);

  // update the bio
  $sql = "UPDATE users SET bio = '$bio' WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);

  // check result, if error print error
  if (!$result) {
    $error = 'Error: ' . mysqli_error($conn);
    echo $error;
  } else {
    header("Location: /profile/?user=$username");
  }
}

?>

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
  <title><?php echo $username; ?>'s profile | Forum Warga <?php echo $forumName; ?></title>
</head>

<body>
  <main class="center-vertical-horizontal">
    <div class="container">
      <div class="row bg-white">
        <div class="panel panel-default" style="padding: 12px;">
          <div class="panel-heading">
            <a href="/profile?user=<?php echo $username ?>" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left"></i> Go back to user profile
            </a>

          </div>
          <div class="panel-body">
            <form action="" method="POST">
              <div class="form-group mb-3">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" cols="30" rows="10" class="form-control"><?php echo $bio; ?></textarea>
              </div>
              <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>

</html>