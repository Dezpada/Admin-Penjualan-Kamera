<?php
include '../connection/connection.php';

$level = "";

if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  $sql = mysqli_query($conn, "select * from login where USERNAME = '$_POST[username]' and PASSWORD = '$_POST[password]'");
  $cek = mysqli_num_rows($sql);
  if ($cek > 0) {
    echo "<p>Wrong username or password!</p>";
    echo "<meta http-equiv=refresh content=3;URL='register.php'>";
  } else {
    $level = "Administrator";
    $sql = mysqli_query($conn, "CALL Create_Login('$level','$username','$password')");
    $cek = mysqli_num_rows($sql);
    echo 'You have entered valid use name and password';
    echo "<meta http-equiv=refresh content=0;URL='../index.php'>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Register</h3>
              <form method="POST">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" id="username" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" id="password" class="form-control p_input">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                </div>
                <p class="sign-up text-center">Already have an Account?<a href="../index.php"> Sign Up</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
</body>

</html>