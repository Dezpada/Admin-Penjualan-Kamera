<?php
include './connection/connection.php';

if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  $sql = mysqli_query($conn, "select * from login where USERNAME = '$_POST[username]' and PASSWORD = '$_POST[password]'");
  $cek = mysqli_num_rows($sql);
  if ($cek > 0) {
    $data = mysqli_fetch_assoc($sql);
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = $_POST['username'];
    echo 'You have entered valid use name and password';
    echo "<meta http-equiv=refresh content=0;URL='./pages/account.php'>";
  } else {
    echo "<p>Wrong username or password!</p>";
    echo "<meta http-equiv=refresh content=3;URL='index.php'>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CamRe Admin</title>
  <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Login</h3>
              <form method="POST">
                <div class="form-group">
                  <label>Username *</label>
                  <input type="text" class="form-control p_input" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="password" class="form-control p_input" name="password" placeholder="Password">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn" name="login">Login</button>
                </div>
                <p class="sign-up">Don't have an Account?<a href="./pages/register.php"> Sign Up</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="./assets/js/off-canvas.js"></script>
  <script src="./assets/js/hoverable-collapse.js"></script>
  <script src="./assets/js/misc.js"></script>
  <script src="./assets/js/settings.js"></script>
</body>

</html>