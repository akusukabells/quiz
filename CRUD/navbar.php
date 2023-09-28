<?php
/*getting active page name*/
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<div class="sidebar" data-color="orange">
    <div class="logo" style="padding:unset;">
        <a href="../admin/dashboard.php" class="simple-text logo-mini" style="width:110px;padding-left:10px;">
            adminpanel
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="../admin/dashboard.php">
                    <i class="now-ui-icons shopping_shop"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="../admin/class.php">
                    <i class="now-ui-icons education_agenda-bookmark"></i>
                    <p>Class</p>
                </a>
            </li>
            <li>
                <a href="../admin/level.php">
                    <i class="now-ui-icons design-2_ruler-pencil"></i>
                    <p>Level</p>
                </a>
            </li>
            <li>
                <a href="../admin/question.php">
                    <i class="now-ui-icons files_single-copy-04"></i>
                    <p>Question</p>
                </a>
            </li>
            <li>
                <a href="../admin/users.php">
                    <i class="now-ui-icons users_circle-08"></i>
                    <p>Users</p>
                </a>
            </li>
            <li>
                <a href="../admin/changepassword.php">
                    <i class="now-ui-icons users_circle-08"></i>
                    <p>Change Password</p>
                </a>
            </li>
            <li>
                <a href="../admin/resetpassword.php">
                    <i class="now-ui-icons users_circle-08"></i>
                    <p>Reset Password</p>
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