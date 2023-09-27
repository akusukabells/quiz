<?php
session_start();
include('../connector/dbcon.php');
$nis = $_POST['nis'];
$password = sha1($_POST['password']);
$reference = $database->getReference('Users/' . $nis)->getValue();
if ($reference > 0) {
    if ($reference['password'] == $password) {
        $_SESSION['nis'] = $reference['nis'];
        $_SESSION['role'] = $reference['role'];
        $_SESSION['name'] = $reference['name'];
        if ($reference['role'] == "1") {
            header("location: ../admin/dashboard.php");
        } else {
            header("location: ../student/dashboard.php");
        }
    } else {
        $_SESSION['status'] = "Password Anda Salah";
        header("location: ../index.php");
    }
} else {
    $_SESSION['status'] = "NIS Tidak Ditemukan";
    header("location: ../index.php");
}
