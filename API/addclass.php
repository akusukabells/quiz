<?php
session_start();
include('../connector/dbcon.php');

if (isset($_POST['adddata'])) {
    $nis = $_POST['nis'];
    $idclass = $_POST['idclass'];
    $postData = [
        'nis' => $nis,
        'idclass' => $idclass
    ];
    $getNIS = $database->getReference("Users/" . $nis)->getValue();
    if ($getNIS > 0) {
        $postRef_result = $database->getReference("AddClass/" . $nis . "/" . $idclass)->set($postData);
        if ($postRef_result) {
            $_SESSION['status'] = "Successfully Add Class";
            header("location:../CRUD/addclass.php");
        } else {
            $_SESSION['status'] = "Successfully Add Class";
            header("location:../CRUD/addclass.php");
        }
    } else {
        $_SESSION['notif'] = "NIS Not Found";
        header("location:../CRUD/addclass.php");
    }
}
