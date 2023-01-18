<?php
include '../connection/connection.php';

$id_pay = "";
$id_book = "";
$status = "";
$date = "";

if (isset($_GET['action'])) {
  $action = $_GET['action'];
} else {
  $action = "";
}

if (isset($_POST['insert'])) {
  header("Refresh:0; url=print.php");
}

if (isset($_POST['insert'])) {
  if (isset($_POST['inputBookID'])) {
    $id_book = $_POST['inputBookID'];
  }
  $id_pay = $_POST['inputPayID'];
  $status = $_POST['inputStatus'];
  $date = $_POST['inputDate'];
  $query = "CALL Create_Bayar('$id_pay','$id_book','$status','$date');";
  $result = mysqli_query($conn, $query);
  if ($result) {
    header("Location: payment.php");
  } else {
    echo "Gagal menambah data";
  }
  header("Refresh:0; url=payment.php");
}

if (isset($_POST['update'])) {
  if (isset($_POST['inputBookID'])) {
    $id_book = $_POST['inputBookID'];
  }
  $id_pay = $_POST['inputPayID'];
  $status = $_POST['inputStatus'];
  $date = $_POST['inputDate'];
  $query = "UPDATE pembayaran SET ID_PESAN='$id_book',TANGGAL_BAYAR='$date',STATUS_BAYAR='$status' WHERE ID_BAYAR='$id_pay'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    header("Location: payment.php");
  } else {
    echo "Gagal menambah data";
  }
  header("Refresh:0; url=payment.php");
}

if ($action == "update") {
  $id_pay = $_GET['id'];
  $query = "SELECT * FROM pembayaran WHERE ID_BAYAR='$id_pay'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $id_pay = $row['ID_BAYAR'];
  $id_book = $row['ID_PESAN'];
  $status = $row['STATUS_BAYAR'];
  $date = $row['TANGGAL_BAYAR'];
}

if ($action == "delete") {
  $id_pay = $_GET['id'];
  $query = "CALL Delete_Bayar('$id_pay')";
  $result = mysqli_query($conn, $query);
  if ($result) {
    header("Location: payment.php");
  } else {
    echo "Gagal menghapus data";
  }
  header("Refresh:0; url=payment.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Payment</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <div class="container-scroller">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="account.php"><img src="../assets/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="account.php"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
      </div>
      <ul class="nav">
        <li class="nav-item profile">
          <div class="profile-desc">
            <div class="profile-pic">
              <div class="count-indicator">
                <img class="img-xs rounded-circle " src="../assets/images/faces/face15.jpg" alt="">
                <span class="count bg-success"></span>
              </div>
              <div class="profile-name">
                <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
                <span>Administrator</span>
              </div>
            </div>
            <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
            <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-onepassword  text-info"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="../index.php" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-logout  text-info"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">Log Out</p>
                </div>
              </a>
            </div>
          </div>
        </li>
        <li class="nav-item nav-category">
          <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="../pages/account.php">
            <span class="menu-icon">
              <i class="mdi mdi-account"></i>
            </span>
            <span class="menu-title">Account</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="../pages/renter.php">
            <span class="menu-icon">
              <i class="mdi mdi-contacts"></i>
            </span>
            <span class="menu-title">Renter</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="../pages/payment.php">
            <span class="menu-icon">
              <i class="mdi mdi-cash-multiple"></i>
            </span>
            <span class="menu-title">Payment</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="../pages/booking.php">
            <span class="menu-icon">
              <i class="mdi mdi-book"></i>
            </span>
            <span class="menu-title">Booking</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="../pages/camera.php">
            <span class="menu-icon">
              <i class="mdi mdi-camera"></i>
            </span>
            <span class="menu-title">Camera</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="../pages/lenses.php">
            <span class="menu-icon">
              <i class="mdi mdi-camera-iris"></i>
            </span>
            <span class="menu-title">Lenses</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="../pages/facility.php">
            <span class="menu-icon">
              <i class="mdi mdi-camera-enhance"></i>
            </span>
            <span class="menu-title">Facility</span>
          </a>
        </li>
      </ul>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="../pages/account.php"><img src="../assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="../pages/account.php"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Payment</h4>
                  <p class="card-description"> For Insert, Edit, or Delete </p>
                  <form class="forms-sample" method="POST">
                    <div class="form-group row">
                      <label for="inputBookID" class="col-sm-3 col-form-label">Booking ID</label>
                      <div class="col-sm-9">
                        <select id="inputBookID" name="inputBookID" class="form-control" id="floatingSelect" aria-label="Floating label select example">
                          <option value="<?PHP echo $id_book ?>">Pilih Book</option>
                          <?php
                          $sql = "SELECT * FROM pemesanan";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['ID_PESAN'] ?>"><?php echo $row['ID_PESAN'] ?></option>
                          <?php }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPayID" class="col-sm-3 col-form-label">Payment ID</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPayID" name="inputPayID" placeholder="Payment ID" value="<?php echo $id_pay ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputStatus" class="col-sm-3 col-form-label">Status</label>
                      <div class="col-sm-9">
                        <select id="inputStatus" name="inputStatus" class="form-control" id="floatingSelect" aria-label="Floating label select example">
                          <option value="">Pilih Status</option>
                          <option value="DP">DP</option>
                          <option value="Lunas">Lunas</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputDate" class="col-sm-3 col-form-label">Payment Date</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="inputDate" name="inputDate" placeholder="Payment Date" value="<?php echo $date ?>">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-4 mt-4" name="insert">Insert</button>
                    <button type="submit" class="btn btn-primary mr-4 mt-4" name="update">Update</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Payment Table</h4>
                  <p class="card-description"> For checking any payment
                  </p>
                  <div class="table-responsive">
                    <table id="table_id" class="table table-hover">
                      <thead>
                        <tr>
                          <th>Payment ID</th>
                          <th>Booking ID</th>
                          <th>Status</th>
                          <th>Payment Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?PHP
                        $query = "SELECT * FROM pembayaran";
                        $result = mysqli_query($conn, $query);
                        while ($row_select = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td>" . $row_select['ID_BAYAR'] . "</td>";
                          echo "<td>" . $row_select['ID_PESAN'] . "</td>";
                          echo "<td>" . $row_select['STATUS_BAYAR'] . "</td>";
                          echo "<td>" . $row_select['TANGGAL_BAYAR'] . "</td>";
                          echo "<td>";
                          echo "<a href='payment.php?action=update&id=" . $row_select['ID_BAYAR'] . "' class='btn btn-primary m-1 btn-edit'><i class='mdi mdi-pencil'></i></a>";
                          echo "<a href='payment.php?action=delete&id=" . $row_select['ID_BAYAR'] . "' onclick='return confirm(\"Apakah anda yakin ingin menghapus data ?\")' class='btn btn-danger m-1'><i class='mdi mdi-delete'></i></a>";
                          echo "<a href='print.php?id=" . $row_select['ID_BAYAR'] . "' class='btn btn-primary m-1 btn-edit'><i class='mdi mdi-printer'></i></a>";
                          echo "</td>";
                          echo "</tr>";
                        }
                        ?>

                        <?PHP

                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Daniel Nugroho Simanjuntak 2022</span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready(function() {
      $('#table_id').DataTable();
    });
  </script>
</body>

</html>