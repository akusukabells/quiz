<?php
session_start();
include('../connector/dbcon.php');

if (isset($_POST['goaddreward'])) {
    header("location:../CRUD/reward.php");
}

if (isset($_POST['addreward'])) {
    $jaura1 = $_POST['juara_1'];
    $jaura2 = $_POST['juara_2'];
    $jaura3 = $_POST['juara_3'];

    $postdata = [
        'juara_1' => $jaura1,
        'juara_2' => $jaura2,
        'juara_3' => $jaura3
    ];

    $delete = $database->getReference('Reward')->remove();
    $deleteexp = $database->getReference('exp')->remove();
    $result = $database->getReference('Reward')->set($postdata);
    if ($result) {
        $_SESSION['status'] = "Successfully Set Data";
        header("location:../admin/reward.php");
    } else {
        $_SESSION['status'] = "Failed set Data";
        header("location:../admin/reward.php");
    }
}
