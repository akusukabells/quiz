<?php
session_start();
include('../connector/dbcon.php');

if (isset($_POST['goadd'])) {
    unset($_SESSION['edit']);
    $getId = $database->getReference("Users")->getValue();
    $id = 1;
    $setID = "";
    foreach ($getId as $key => $row) {
        if ($row['nis'] != getId($id)) {
            $setID = getId($id);
        } else {
            $id++;
        }
    }
    $_SESSION['id'] = getId($id);
    header("location:../CRUD/users.php");
}

if (isset($_POST['adddata'])) {
    $nis = $_POST['nis'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = sha1($nis);

    $postData = [
        'nis' => $nis,
        'name' => $name,
        'role' => $role,
        'password' => $password
    ];
    $postRef_result = $database->getReference("Users/" . $nis)->set($postData);
    if ($postRef_result) {
        $_SESSION['status'] = "Successfully Adding Data";
        header("location:../admin/users.php");
    } else {
        $_SESSION['status'] = "Failed Adding Data";
        header("location:../admin/users.php");
    }
}

if (isset($_POST['goedit'])) {
    $_SESSION['edit'] = $_POST['goedit'];
    header("location:../CRUD/users.php");
}
if (isset($_POST['edit'])) {
    $nis = $_POST['nis'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = sha1($nis);

    $postData = [
        'nis' => $nis,
        'name' => $name,
        'role' => $role,
        'password' => $password
    ];
    $postRef_result = $database->getReference("Users/" . $nis)->set($postData);
    if ($postRef_result) {
        unset($_SESSION['edit']);
        $_SESSION['status'] = "Successfully Update Data";
        header("location:../admin/users.php");
    } else {
        unset($_SESSION['edit']);
        $_SESSION['status'] = "Failed Update Data";
        header("location:../admin/users.php");
    }
}

if (isset($_POST['delete'])) {
    $nis = $_POST['delete'];
    $delete_Result = $database->getReference('Users/' . $nis)->remove();
    if ($delete_Result) {
        $_SESSION['status'] = "Successfully Delete Data";
        header("location:../admin/users.php");
    } else {
        $_SESSION['status'] = "Failed Delete Data";
        header("location:../admin/users.php");
    }
}

function getId($id)
{
    if ($id > 99) {
        return "U-" . $id;
    } else {
        if ($id > 9) {
            return "U-0" . $id;
        } else {
            return "U-00" . $id;
        }
    }
}
