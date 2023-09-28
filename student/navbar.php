<?php
/*getting active page name*/
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<div class="sidebar" data-color="orange">
    <div class="logo" style="padding:unset;">
        <a href="dashboard.php" class="simple-text logo-mini" style="width:80%">
            Hallo, <?php echo $_SESSION['name']; ?><br>
            Score <?php
                    include('../connector/dbcon.php');
                    $getexp = $database->getReference('exp/' . $_SESSION['nis'])->getValue();
                    if ($getexp > 0) {
                        echo $getexp['exp'];
                    } else {
                        echo "0";
                    }
                    ?>
        </a>

    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="dashboard.php">
                    <i class="now-ui-icons shopping_shop"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="changepassword.php">
                    <i class="now-ui-icons loader_gear"></i>
                    <p>Change Password</p>
                </a>
            </li>
            <li>
                <a href="../API/logout.php">
                    <i class="now-ui-icons media-1_button-power"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>