<!DOCTYPE html>
<html lang="en">

<?php
// session
session_start();

// include db connect
include $_SERVER['DOCUMENT_ROOT'] . '/helper/php/connection.php';

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="index.css">
  <link rel="icon" href="/favicon.ico">

  <title>Forum Warga <?php echo $forumName ?></title>
</head>

<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/components/navbar.php' ?>
  <main style="margin-top: 50px">
    <div class="container">
      <div class="row">
        <?php
        if (isset($_SESSION['username'])) {
          echo '<div class="col-lg-8 mb-3 me-3">';
        } else {
          echo '<div class="col-lg-12 mb-3">';
        }
        ?>
        <div class="row text-left mb-5">
          <div class="col-lg-6 mb-3 mb-sm-0">
            <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50"
              style="width: 100%;">
              <select class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" data-toggle="select"
                tabindex="-98" id="dynamic_select">
                <option value="/"> All </option>
                <?php
                // check for GET request named "topic"
                if (isset($_GET['topic'])) {
                  // if found, get the value
                  $topic = $_GET['topic'];
                  $topic = strip_tags($topic);
                  $topic = mysqli_real_escape_string($conn, $topic);
                  echo '<option value="/?topic=' . $topic . '" selected hidden>' . $topic . '</option>';
                } else if (isset($_GET['by'])) {
                  // if found, get the value
                  $by = $_GET['by'];
                  $by = strip_tags($by);
                  $by = mysqli_real_escape_string($conn, $by);
                  echo '<option value="/?by=' . $by . '" selected hidden>Seeing post made by ' . $by . '</option>';
                }

                // get all topics from db
                $sql = "SELECT * FROM topic";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="/?topic=' . $row['name'] . ' "> ' . $row['name'] . '</option>';
                }
                ?>
              </select>
              <script>
              $(function() {
                // bind change event to select
                $('#dynamic_select').on('change', function() {
                  var url = $(this).val(); // get selected value
                  if (url) { // require a URL
                    window.location = url; // redirect
                  }
                  return false;
                });
              });
              </script>
            </div>
          </div>
          <div class=" col-lg-6 text-lg-right">
            <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50"
              style="width: 100%;">
              <select class="form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" data-toggle="select"
                tabindex="-98" disabled>
                <option id="time"> Date Time </option>
              </select>
            </div>
          </div>
        </div>
        <div
          class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-1 border-right-1 border-bottom-1 rounded-0">
          <div class="row align-items-center">
            <h1>About</h1>
            <p>
              A forum website inteded to be used as a platform for people to discuss about anything they want.
            </p>
          </div>

          <figcaption>
            <a class="btn btn-primary" href="/">Back to Home Page</a>
          </figcaption>
        </div>

      </div>
      <!-- Sidebar content -->
      <div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
        <div
          style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;">
        </div>
        <div data-toggle="sticky" class="sticky" style="top: 85px;">
          <div class="sticky-inner">
            <?php
            // check if user is logged in or not
            if (isset($_SESSION['username'])) {
              // get amount of user posts
              $sql = "SELECT COUNT(*) AS total FROM post WHERE userId = '" . $_SESSION['username'] . "'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              $total = $row['total'];

              // get amount of user notifcations
              $sql = "SELECT COUNT(*) AS total FROM notification WHERE userId = '" . $_SESSION['username'] . "' AND isRead = 0";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              $totalNotif = $row['total'];

              // if user is logged in, show the logout button
              echo '
                <div class="bg-white text-sm">
                  <h4 class="px-3 py-4 op-5 m-0 roboto-bold">
                      Dashboard
                  </h4>
                  <hr class="my-0" />
                  <div class="row text-center d-flex flex-row op-7 mx-0">
                    <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> 
                      <a class="d-block lead font-weight-bold" href="/?by=' . $_SESSION['username'] . '">' . $total . '</a> Posts 
                    </div>
                    <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> 
                      <a class="d-block lead font-weight-bold" href="/profile/notification.php?user=' . $_SESSION['username'] . '">' . $totalNotif . '</a> 
                      Unread Notification 
                    </div>
                  </div>
                </div>
                ';
            }
            ?>
            <div class="mt-1">
              <div id="google_translate_element"></div>

              <script type="text/javascript">
              function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                  pageLanguage: 'en',
                  layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
              }
              </script>
              <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
                type="text/javascript">
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="/helper/js/timer.js"> </script>

</body>

</html>