<!DOCTYPE html>
<html lang="en">

<?php
// session
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/checkAdmin.php';

// POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get the data
  $forumName = $_POST['forumName'];
  $forumName = strip_tags($forumName);
  $forumName = mysqli_real_escape_string($conn, $forumName);

  // first check if forum name exist or not
  $sql = "SELECT * FROM web_config WHERE id = 1";
  $result = mysqli_query($conn, $sql);

  // if not exist then create a new one
  if (mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO web_config (forum_name) VALUES ('$forumName')";
  } else {
    // else update the name
    $sql = "UPDATE web_config SET forum_name = '$forumName' WHERE id = 1";
  }

  $result = mysqli_query($conn, $sql);

  // check result, if error print error
  if (!$result) {
    $error = 'Error: ' . mysqli_error($conn);
    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
  } else {
    // redirect to admin menu
    header("Location: /admin?success=1");
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="/index.css">
  <link rel="icon" href="/favicon.ico">
  <title>Admin Dashboard | Forum Warga <?php echo $forumName; ?></title>
</head>

<body>
  <?php
  if (isset($_GET['success'])) {
    echo '<div id="alert-success" class="alert alert-success" role="alert">Successfully changed forum name!</div>';

    echo '
    <script>
      $(document).ready(function() {
        $("#alert-success").delay(2000).fadeOut("slow");
      });
    </script>
    ';
  }
  ?>

  <main class="center-vertical-horizontal">
    <div class="container">
      <div class="row bg-white">
        <div class="panel panel-default" style="padding: 12px;">
          <div class="panel-heading">
            <a href="/" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left"></i> Go back to home page
            </a>
          </div>
          <div class="panel-body d-flex flex-column">
            <div class="mx-auto">
              <div>
                <!-- btn to topic menu -->
                <a href="/admin/topic" class="btn btn-primary btn-sm">
                  <i class="bi bi-book-fill"></i> Topics Menu
                </a>
                <!-- btn to user menu -->
                <a href="/admin/user" class="btn btn-primary btn-sm">
                  <i class="bi bi-people-fill"></i> User Management
                </a>
              </div>
            </div>

            <!-- form for web config -->
            <div>
              <form action="" method="POST" class="mx-auto">
                <div class="mb-3">
                  <label for="forumName" class="form-label">Forum Name</label>
                  <input type="text" class="form-control" id="forumName" name="forumName"
                    value="<?php echo $forumName; ?>">
                </div>

                <!-- btn -->
                <button type="submit" class="btn btn-primary btn-sm">
                  <i class="bi bi-save"></i> Save
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>

</html>