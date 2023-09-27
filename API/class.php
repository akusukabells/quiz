<?php
session_start();
include('../connector/dbcon.php');

if (isset($_POST['goaddclass'])) {
    unset($_SESSION['edit']);
    $getId = $database->getReference("Class")->getValue();
    $id = 1;
    $setID = "";
    foreach ($getId as $key => $row) {
        if ($row['idclass'] != getId($id)) {
            $setID = getId($id);
        } else {
            $id++;
        }
    }
    $_SESSION['id'] = getId($id);
    header("location:../CRUD/class.php");
}

if (isset($_POST['adddataclass'])) {
    $idclass = $_POST['idclass'];
    $nameclass = $_POST['nameclass'];

    $postData = [
        'idclass' => $idclass,
        'nameclass' => $nameclass
    ];
    $postRef_result = $database->getReference("Class/" . $idclass)->set($postData);
    if ($postRef_result) {
        $_SESSION['status'] = "Successfully Adding Data";
        header("location:../admin/class.php");
    } else {
        $_SESSION['status'] = "Failed Adding Data";
        header("location:../admin/class.php");
    }
}

if (isset($_POST['edit'])) {
    $_SESSION['edit'] = $_POST['edit'];
    header("location:../CRUD/class.php");
}
if (isset($_POST['editclass'])) {
    $idclass = $_POST['idclass'];
    $nameclass = $_POST['nameclass'];
    $postData = [
        'idclass' => $idclass,
        'nameclass' => $nameclass
    ];
    $postRef_result = $database->getReference("Class/" . $idclass)->set($postData);
    if ($postRef_result) {
        unset($_SESSION['edit']);
        $_SESSION['status'] = "Successfully Update Data";
        header("location:../admin/class.php");
    } else {
        unset($_SESSION['edit']);
        $_SESSION['status'] = "Failed Update     Data";
        header("location:../admin/class.php");
    }
}

if (isset($_POST['delete'])) {
    $idclass = $_POST['delete'];
    $delete_Result = $database->getReference('Class/' . $idclass)->remove();
    if ($delete_Result) {
        $_SESSION['status'] = "Successfully Delete Data";
        header("location:../admin/class.php");
    } else {
        $_SESSION['status'] = "Failed Delete Data";
        header("location:../admin/class.php");
    }
}

function getId($id)
{
    if ($id > 99) {
        return "C-" . $id;
    } else {
        if ($id > 9) {
            return "C-0" . $id;
        } else {
            return "C-00" . $id;
        }
    }
}
