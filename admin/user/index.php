<!DOCTYPE html>
<html lang="en">

<?php
// session
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/checkAdmin.php';
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
  <title>Users | Forum Warga <?php echo $forumName; ?></title>
</head>

<body>
  <main class="center-vertical-horizontal">
    <div class="container">
      <div class="row bg-white">
        <div class="panel panel-default" style="padding: 12px;">
          <div class="panel-heading">
            <a href="/admin" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left"></i> Go back to Admin Dashboard
            </a>
            <a href="/auth/register" class="btn btn-primary btn-sm">
              <i class="bi bi-plus"></i> Add new user
            </a>
          </div>
          <div class="panel-body">
            <!-- echo table of tags -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Admin</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // get all users
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                // check result
                if (!$result) {
                  // echo mysql error
                  echo mysqli_error($conn);
                }

                // get amount of resuilt
                $resultCheck = mysqli_num_rows($result);

                // echo table
                if ($resultCheck > 0) {
                  // output data of each row
                  $counter = 0;
                  while ($row = mysqli_fetch_assoc($result)) {
                    $counter += 1;
                    $username = $row['username'];
                    $email = $row['email'];
                    $admin = $row['isAdmin'] ? "Yes" : "No";
                    echo '<tr>';
                    echo '<th scope="row">' . $counter . '</th>';
                    echo '<td>' . $username . '</td>';
                    echo '<td>' . $email . '</td>';
                    echo '<td>' . $admin . '</td>';
                    echo '
                    <td>
                      <a href="edit_user.php?username=' . $username . '" class="btn btn-primary btn-sm">Edit</a> 
                      <a onclick="deleteUser(\'' . $username . '\')" class="btn btn-danger btn-sm">Delete</a>
                      <a onclick="changePassword(\'' . $username . '\')" class="btn btn-warning btn-sm">Change Password</a>
                    </td>';
                    echo '</tr>';
                  }
                } else {
                  echo '<tr>';
                  echo '<th scope="row">0</th>';
                  echo '<td>No User</td>';
                  echo '<td>0</td>';
                  echo '<td><a href="./add_user.php" class="btn btn-primary btn-sm">Add</a></td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
              <script>
              function deleteUser(id) {
                if (confirm("Are you sure you want to delete this user?")) {
                  // send ajax request
                  $.ajax({
                    url: "./delete_user",
                    method: "POST",
                    data: {
                      id: id
                    },
                    success: function(data) {
                      if (data == "success") {
                        // reload page
                        location.reload();
                      } else {
                        alert(data);
                      }
                    }
                  });
                }
              }

              function changePassword(id) {
                if (confirm("Are you sure you want to change password of this user?")) {
                  // prompt password
                  const password = prompt("Please enter new password", "");

                  // confirm password
                  if (password != null) {
                    // ask confirmation with the password inputted
                    if (confirm("Are you sure you want to change password of this user to " + password + "?")) {
                      // send ajax request
                      $.ajax({
                        url: "./reset_password",
                        method: "POST",
                        data: {
                          id: id,
                          password: password
                        },
                        success: function(data) {
                          if (data == "success") {
                            alert("Password changed successfully");
                            // reload page
                            location.reload();
                          } else {
                            alert(data);
                          }
                        }
                      });
                    } else {
                      alert("Password change cancelled");
                    }
                  } else {
                    alert("Password change cancelled");
                  }
                }
              }
              </script>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>

</html>