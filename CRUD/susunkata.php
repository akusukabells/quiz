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
    <script>
        function showedit() {
            // Generate a dynamic number of inputs
            var number = document.getElementById("member").value;
            // Get the element where the inputs will be added to
            var container = document.getElementById("container");
            // Remove every children it had before
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i = 0; i < number; i++) {
                // Append a node with a random text
                container.appendChild(document.createTextNode("Option " + (i + 1)));

                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.type = "text";
                input.className = "form-control";
                input.name = "option" + i;
                container.appendChild(input);
                // Append a line break 
                container.appendChild(document.createElement("br"));
            }
        }
    </script>
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
                        <?php include("../admin/logo.php"); ?>
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
                        <div class="card" style="min-height:400px;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="title">Question</h5>
                                    </div>
                                </div>
                                <?php
                                include("../connector/dbcon.php");
                                if (!empty($_SESSION['edit'])) {
                                    $getData = $database->getReference("Question/" . $_SESSION['edit'])->getValue();
                                ?>
                                    <div id="form_part1">
                                        <form method="post" action="../API/question.php">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">ID Question</label>
                                                <input type="text" class="form-control" name="idquestion" value="<?php echo $_SESSION['edit']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Level</label>
                                                <select class="form-control" name="idlevel">
                                                    <?php
                                                    $getClass = $database->getReference("Level")->getValue();
                                                    if ($getClass > 0) {
                                                        foreach ($getClass as $key => $row) {
                                                            echo "<option value=" . $row['idlevel'] . ">" . $row['namelevel'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Question</label>
                                                <textarea class="form-control" name="question" rows="3" placeholder="Question"><?php echo $getData['question']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Option Fills</label>
                                                <input type="number" id="member" class="form-control" name="member" placeholder="Number Fills" value="<?php echo $getData['option']; ?>"><br />
                                                <a href="#" class=" btn btn-primary btn-block btn-round" id="filldetails" onclick="addFields()">Fill Details</a>
                                                <div id="container" onload="edit()" />
                                            </div>
                                            <div class=" form-group">
                                                <label for="exampleFormControlTextarea1">Answer</label>
                                                <input class="form-control" name="answer" placeholder="Answer" value="<?php echo $getData['answer']; ?>"></input>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Score</label>
                                                <input type="number" class="form-control" name="score" placeholder="Score" value="<?php echo $getData['score']; ?>">
                                            </div>
                                            <button class=" btn btn-primary btn-block btn-round" name="editsusunkata" style="margin-top:50px;float:right !important;">Add Question</button>

                                        </form>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div id="form_part1">
                                        <form method="post" action="../API/question.php">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">ID Question</label>
                                                <input type="text" class="form-control" name="idquestion" value="<?php echo $_SESSION['id']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Level</label>
                                                <select class="form-control" name="idlevel">
                                                    <?php
                                                    $getClass = $database->getReference("Level")->getValue();
                                                    if ($getClass > 0) {
                                                        foreach ($getClass as $key => $row) {
                                                            echo "<option value=" . $row['idlevel'] . ">" . $row['namelevel'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Question</label>
                                                <textarea class="form-control" name="question" rows="3" placeholder="Question"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Option Fills</label>
                                                <input type="number" id="member" class="form-control" name="member" placeholder="Number Fills"><br />
                                                <a href="#" class=" btn btn-primary btn-block btn-round" id="filldetails" onclick="showedit()">Fill Details</a>
                                                <?php echo '<script type="text/javascript">showedit();</script>'; ?>
                                                <div id="container" />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Answer</label>
                                                <input class="form-control" name="answer" placeholder="Answer"></input>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Score</label>
                                                <input type="number" class="form-control" name="score" placeholder="Score">
                                            </div>
                                            <button class=" btn btn-primary btn-block btn-round" name="adddatasusunkata" style="margin-top:50px;float:right !important;">Add Question</button>

                                        </form>
                                    </div>
                                <?php
                                }
                                ?>
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
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
    <script>
        shows_form_part(1)

        /* this function shows form part [n] and hides the remaining form parts */
        function shows_form_part(n) {
            var i = 1,
                p = document.getElementById("form_part" + 1);
            while (p !== null) {
                if (i === n) {
                    p.style.display = "";
                } else {
                    p.style.display = "none";
                }
                i++;
                p = document.getElementById("form_part" + i);
            }
        }

        /* this is called at the last step using info filled during the previous steps*/
        function calc_sum() {
            var sum =
                parseInt(document.getElementById("num1").value) +
                parseInt(document.getElementById("num2").value) +
                parseInt(document.getElementById("num3").value);

            alert("The sum is: " + sum);
        }
    </script>
    <script type='text/javascript'>
        function addFields() {
            // Generate a dynamic number of inputs
            var number = document.getElementById("member").value;
            // Get the element where the inputs will be added to
            var container = document.getElementById("container");
            // Remove every children it had before
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i = 0; i < number; i++) {
                // Append a node with a random text
                container.appendChild(document.createTextNode("Option " + (i + 1)));

                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.type = "text";
                input.className = "form-control";
                input.name = "option" + i;
                container.appendChild(input);
                // Append a line break 
                container.appendChild(document.createElement("br"));
            }
        }
    </script>
    <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->
</body>


</html>