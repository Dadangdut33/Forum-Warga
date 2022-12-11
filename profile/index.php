<!DOCTYPE html>
<html lang="en">

<?php
// session
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/fetchUserProfile.php';

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
            <a href="/" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left"></i> Go back home
            </a>
            <?php
            // if the user is logged in and the user is the same as the profile, add btn to redirect to edit_bio
            if (isset($_SESSION['username']) && $_SESSION['username'] == $username) {
              echo '<a href="/profile/edit_bio" class="btn btn-secondary btn-sm">
                <i class="bi bi-pencil"></i> Edit bio
              </a>';
            }
            ?>

          </div>
          <div class="panel-body">
            <div class="d-flex justify-content-center">
              <h1 class="panel-title"><?php echo $username; ?></h1>
              </h1>
            </div>
            <div class="d-flex justify-content-center">
              <h4>At <?php echo $email ?></h4>
            </div>
            <div class="d-flex justify-content-center">
              <a href="/?by=<?php echo $username; ?>">Click to see <?php echo $username; ?>'s
                posts</a>
            </div>
            <div class="d-flex justify-content-center mt-2">
              <p><?php echo $bio; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>

</html>