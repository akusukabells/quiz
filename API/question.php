<?php
session_start();
include('../connector/dbcon.php');

if (isset($_POST['goadd'])) {
    unset($_SESSION['edit']);
    $getId = $database->getReference("Question")->getValue();
    $id = 1;
    $setID = "";
    foreach ($getId as $key => $row) {
        if ($row['idquestion'] != getId($id)) {
            $setID = getId($id);
        } else {
            $id++;
        }
    }
    $_SESSION['id'] = getId($id);
    header("location:../CRUD/question.php");
}

if (isset($_POST['adddata'])) {
    $idquestion = $_POST['idquestion'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $answer = $_POST['answer'];
    $idlevel = $_POST['idlevel'];
    $score = $_POST['score'];

    $postData = [
        'idquestion' => $idquestion,
        'question' => $question,
        'option_a' => $option_a,
        'option_b' => $option_b,
        'option_c' => $option_c,
        'option_d' => $option_d,
        'answer' => $answer,
        'idlevel' => $idlevel,
        'score' => $score
    ];
    $postRef_result = $database->getReference("Question/" . $idquestion)->set($postData);
    if ($postRef_result) {
        unset($_SESSION['id']);
        $_SESSION['status'] = "Successfully Adding Data";
        header("location:../admin/question.php");
    } else {
        unset($_SESSION['id']);
        $_SESSION['status'] = "Failed Adding Data";
        header("location:../admin/question.php");
    }
}

if (isset($_POST['goedit'])) {
    $_SESSION['edit'] = $_POST['goedit'];
    header("location:../CRUD/question.php");
}
if (isset($_POST['edit'])) {
    $idquestion = $_POST['idquestion'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $answer = $_POST['answer'];
    $idlevel = $_POST['idlevel'];
    $score = $_POST['score'];

    $postData = [
        'idquestion' => $idquestion,
        'question' => $question,
        'option_a' => $option_a,
        'option_b' => $option_b,
        'option_c' => $option_c,
        'option_d' => $option_d,
        'answer' => $answer,
        'idlevel' => $idlevel,
        'score' => $score
    ];
    $postRef_result = $database->getReference("Question/" . $idquestion)->set($postData);
    if ($postRef_result) {
        unset($_SESSION['edit']);
        $_SESSION['status'] = "Successfully Update Data";
        header("location:../admin/question.php");
    } else {
        unset($_SESSION['edit']);
        $_SESSION['status'] = "Failed Update Data";
        header("location:../admin/question.php");
    }
}

if (isset($_POST['delete'])) {
    $idquestion = $_POST['delete'];
    $delete_Result = $database->getReference('Question/' . $idquestion)->remove();
    if ($delete_Result) {
        $_SESSION['status'] = "Successfully Delete Data";
        header("location:../admin/question.php");
    } else {
        $_SESSION['status'] = "Failed Delete Data";
        header("location:../admin/question.php");
    }
}

function getId($id)
{
    if ($id > 99) {
        return "Q-" . $id;
    } else {
        if ($id > 9) {
            return "Q-0" . $id;
        } else {
            return "Q-00" . $id;
        }
    }
}
