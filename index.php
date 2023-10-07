<?php
session_start();
if (!empty($_SESSION['nis'])) {
  if ($_SESSION['role'] == "1") {
    header("location: admin/dashboard.php");
  } else if ($_SESSION['role'] == "0") {
    header("location: student/dashboard.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <title>
    Login
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/main.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <link href="https://fonts.cdnfonts.com/css/blackpool" rel="stylesheet">
</head>

<body class="">
  <div class="wrapper">
    <div class="main-panel" style="width:100% !important">
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content" style="min-height: calc(92vh - 123px) !important;">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="card-header">
              <center>
                <h1 style="font-family:blackpool;color:#f96332;font-size:50px"><b>Hafiz Chalange</b></h1>
              </center>
            </div>
            <div class="card">
              <div class="card-header">
                <center>
                  <h5 class="title">Login</h5>
                </center>
              </div>
              <div class="card-body">
                <form method="post" action="API/auth.php">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>NIS</label>
                        <input type="number" id="nis" name="nis" class="form-control" placeholder="Nomor Induk Siswa">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                      </div>
                    </div>
                  </div>
                  <div class="row center-element py-3">
                    <div class="col-md-8">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block btn-round" name="login">LOGIN</button>
                      </div>
                    </div>
                  </div>

                  <?php
                  if (isset($_SESSION['status'])) {
                  ?>

                    <center>
                      <font color="#FF0000"> <?php echo $_SESSION['status']; ?></font>
                    </center>

                  <?php
                    unset($_SESSION['status']);
                  }
                  ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <center>
                          <div id="result"></div>
                        </center>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4"></div>

        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright">
            &copy;
            Hafiz Chalange
          </div>
        </div>
      </footer>

    </div>
  </div>


</body>

</html>