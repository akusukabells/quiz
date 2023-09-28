<?php
session_start();
if (!isset($_SESSION["nis"]))
    header("Location:../index.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="robots" content="noindex">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="-1" />
    <title>
        Result
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <!-- <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
    <!-- <link type="text/css" rel="stylesheet" href="http://jqueryte.com/css/jquery-te.css" charset="utf-8"> -->
    <link href="../assets/css/main.css" rel="stylesheet" />
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto;
            padding: 10px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            font-size: 25px;
            text-align: center;
        }

        .grid-count {
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>

<body class="">
    <div class="wrapper ">
        <!-- sidebar -->
        <?php
        include "navbar.php";
        ?>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#pablo">Result</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <?php include "navitem.php"; ?>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content" style="min-height: auto;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="card" style="min-height:400px;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="title">Result</h5>
                                        </div>
                                    </div>
                                    <!-- konten   -->

                                    <form method="post" action="../API/student_class.php">


                                        <table class="table table-hover" style="margin-left:1%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Jawaban</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Score</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include('../connector/dbcon.php');
                                                for ($i = 1; $i < $_SESSION['number']; $i++) {
                                                    $getResult = $database->getReference('Temp_Quiz/' . $_SESSION['nis'] . "/" . $i)->getValue();
                                                    if ($getResult > 0) {
                                                ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i; ?></th>
                                                            <th scope="row"><?php echo $getResult['answer_temp']; ?></th>
                                                            <th scope="row"><?php if ($getResult['answer_temp'] == $getResult['answer']) {
                                                                                echo "Benar";
                                                                            } else {
                                                                                echo "Salah";
                                                                            } ?></th>
                                                            <th scope="row"><?php if ($getResult['answer_temp'] == $getResult['answer']) {
                                                                                echo $getResult['score'];
                                                                            } else {
                                                                                echo "0";
                                                                            } ?></th>

                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>

                                        <h3>Score anda adalah : <?php echo $_SESSION['score']; ?></h3>

                                        <button class=" btn btn-primary btn-block btn-round" name="result" style="margin-top:50px;float:right !important;">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- footer -->
            <?php
            include "footer.php";
            ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
    <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->
</body>

</html>