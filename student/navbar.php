<?php
/*getting active page name*/
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<div class="sidebar" data-color="orange">
    <div class="logo" style="padding:unset;">
        <a href="dashboard.php" class="simple-text logo-mini" style="width:80%">
            Hallo, <?php echo $_SESSION['name']; ?>
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
                <a href="dashboard.php">
                    <i class="now-ui-icons education_atom"></i>
                    <p>Education</p>
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