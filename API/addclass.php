<?php
session_start();
include('../connector/dbcon.php');

if (isset($_POST['adddata'])) {
    $nis = $_POST['nis'];
    $idclass = $_SESSION['idclass'];
    $postData = [
        'nis' => $nis,
        'idclass' => $idclass
    ];
    $getNIS = $database->getReference("Users/" . $nis)->getValue();
    if ($getNIS > 0) {
        $postRef_result = $database->getReference("AddClass/" . $idclass . "/" . $nis)->set($postData);
        if ($postRef_result) {
            $_SESSION['status'] = "Successfully Add Class";
            header("location:../admin/addclass.php");
        } else {
            $_SESSION['status'] = "Successfully Add Class";
            header("location:../admin/addclass.php");
        }
    } else {
        $_SESSION['notif'] = "NIS Not Found";
        header("location:../CRUD/addclass.php");
    }
}

if (isset($_POST['goto'])) {
    unset($_SESSION['idclass']);
    $_SESSION['idclass'] = $_POST['goto'];
    header("location:../admin/addclass.php");
}
if (isset($_POST['goadd'])) {
    header("location:../CRUD/addclass.php");
}
