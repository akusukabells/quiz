<?php
session_start();
include('../connector/dbcon.php');

if (isset($_POST['goaddlevel'])) {
    unset($_SESSION['edit']);
    $getId = $database->getReference("Level")->getValue();
    $id = 1;
    $setID = "";
    foreach ($getId as $key => $row) {
        if ($row['idlevel'] != getId($id)) {
            $setID = getId($id);
        } else {
            $id++;
        }
    }
    $_SESSION['id'] = getId($id);
    header("location:../CRUD/level.php");
}

if (isset($_POST['adddatalevel'])) {
    $idlevel = $_POST['idlevel'];
    $namelevel = $_POST['namelevel'];
    $idclass = $_POST['idclass'];

    $postData = [
        'idlevel' => $idlevel,
        'namelevel' => $namelevel,
        'idclass' => $idclass
    ];
    $postRef_result = $database->getReference("Level/" . $idlevel)->set($postData);
    if ($postRef_result) {
        $_SESSION['status'] = "Successfully Adding Data";
        header("location:../admin/level.php");
    } else {
        $_SESSION['status'] = "Failed Adding Data";
        header("location:../admin/level.php");
    }
}

if (isset($_POST['edit'])) {
    $_SESSION['edit'] = $_POST['edit'];
    header("location:../CRUD/level.php");
}
if (isset($_POST['editclass'])) {
    $idlevel = $_POST['idlevel'];
    $namelevel = $_POST['namelevel'];
    $idclass = $_POST['idclass'];

    $postData = [
        'idlevel' => $idlevel,
        'namelevel' => $namelevel,
        'idclass' => $idclass
    ];
    $postRef_result = $database->getReference("Level/" . $idlevel)->set($postData);
    if ($postRef_result) {
        unset($_SESSION['edit']);
        $_SESSION['status'] = "Successfully Update Data";
        header("location:../admin/level.php");
    } else {
        unset($_SESSION['edit']);
        $_SESSION['status'] = "Failed Update Data";
        header("location:../admin/level.php");
    }
}

if (isset($_POST['delete'])) {
    $idlevel = $_POST['delete'];
    $delete_Result = $database->getReference('Level/' . $idlevel)->remove();
    if ($delete_Result) {
        $_SESSION['status'] = "Successfully Delete Data";
        header("location:../admin/level.php");
    } else {
        $_SESSION['status'] = "Failed Delete Data";
        header("location:../admin/level.php");
    }
}

function getId($id)
{
    if ($id > 99) {
        return "L-" . $id;
    } else {
        if ($id > 9) {
            return "L-0" . $id;
        } else {
            return "L-00" . $id;
        }
    }
}
