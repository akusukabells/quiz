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
        Question
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
                        <a class="navbar-brand" href="">Question</a>

                    </div>
                    <?php
                    if (isset($_SESSION['status'])) {
                    ?>
                        <div style="float:right">
                            <?php echo $_SESSION['status']; ?>
                        </div>
                    <?php
                        unset($_SESSION['status']);
                    }
                    ?>

                    <?php include "navitem.php"; ?>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content" style="min-height: auto;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="min-height:400px;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="title">Question</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <form method="post" action="../API/question.php">
                                            <button class="btn btn-primary btn-block btn-round" name="goadd" style="margin-top:0px;width:140px !important;float:right !important;">Add Question</button>
                                        </form>
                                    </div>
                                    <table class="table table-hover" style="margin-left:1%">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">ID Question</th>
                                                <th scope="col">Question</th>
                                                <th scope="col">A</th>
                                                <th scope="col">B</th>
                                                <th scope="col">C</th>
                                                <th scope="col">D</th>
                                                <th scope="col">Answer</th>
                                                <th scope="col">Level</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include("../connector/dbcon.php");
                                            $getData = $database->getReference("Question")->getValue();
                                            $no = 1;
                                            if ($getData > 0) {
                                                foreach ($getData as $key => $row) {
                                            ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $no; ?></th>
                                                        <td><?php echo $row['idquestion']; ?></td>
                                                        <td><?php echo $row['question']; ?></td>
                                                        <td><?php echo $row['option_a']; ?></td>
                                                        <td><?php echo $row['option_b']; ?></td>
                                                        <td><?php echo $row['option_c']; ?></td>
                                                        <td><?php echo $row['option_d']; ?></td>
                                                        <td><?php echo $row['answer']; ?></td>
                                                        <td><?php
                                                            $getLevel = $database->getReference('Level/' . $row['idlevel'])->getValue();
                                                            echo $getLevel['namelevel']; ?></td>
                                                        <td>
                                                            <form method="post" action="../API/question.php">
                                                                <button type="submit" class="btn btn-success" name="goedit" value="<?php echo $row['idquestion']; ?>">Edit</button>
                                                                <button type="submit" class="btn btn-danger" name="delete" value="<?php echo $row['idquestion']; ?>">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $no++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="test_details.php" id="test_details">
                <input type="hidden" id="test_id" name="test_id">
            </form>
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