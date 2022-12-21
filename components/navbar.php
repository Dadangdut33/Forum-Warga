  <header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">Forum Warga <?php echo $forumName ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto me-5">
            <a class="nav-link" aria-current="page" href="/faq.php">FAQ</a>
            <a class="nav-link" href="/about.php">About</a>
            <?php
            if (isset($_SESSION['username'])) {
              echo '
              <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['username'] . '</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a class="dropdown-item" href="/profile/?user=' . $_SESSION['username'] . '">My Profile</a>
                  </li>' . (($_SESSION['isAdmin'] == 1) ? '<li>
                    <a class="dropdown-item" href="/admin.php">Admin Menu</a>
                  </li>' : "") .
                '
                  <li>
                    <a class="dropdown-item" href="/post/create.php">Create Post</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/auth/logout.php">Logout</a>
                  </li>
                </ul> 
              </div>';
            } else {
              echo '
              <a class="nav-link" href="/auth/register.php">Register</a>
              <a class="nav-link" href="/auth/login.php">Login</a>
              ';
            }
            ?>
          </div>
        </div>
      </div>
    </nav>
  </header>