<?php
session_start();
include("../connector/dbcon.php");
if (isset($_POST['gotoLevel'])) {
    unset($_SESSION['idclass']);
    $_SESSION['idclass'] = $_POST['gotoLevel'];
    header("location:../student/class.php");
}
if (isset($_POST['goquiz'])) {
    unset($_SESSION['idlevel']);
    unset($_SESSION['score']);
    $_SESSION['idlevel'] = $_POST['goquiz'];
    $nis = $_SESSION['nis'];
    $nomor = 1;
    $getQuestion = $database->getReference("Question")->getValue();
    if ($getQuestion > 0) {
        foreach ($getQuestion as $key => $row) {
            if ($row['idlevel'] == $_SESSION['idlevel']) {
                $postData = [
                    'idquestion' => $row['idquestion'],
                    'score' => $row['score'],
                    'answer' => $row['answer'],
                    'answer_temp' => "-",
                    'check' => "0"
                ];
                $postTemp = $database->getReference('Temp_Quiz/' . $nis . "/" . $nomor)->set($postData);
                $nomor++;
            }
        }
    }
    $_SESSION['score'] = 0;
    $_SESSION['number'] = 1;
    header("location:../student/quiz.php");
}

if (isset($_POST['quiz'])) {
    $choice = $_POST['choice'];

    $nis = $_SESSION['nis'];

    $gettemp = $database->getReference("Temp_Quiz/" . $nis . "/" . $_SESSION['number'])->getValue();
    $getQuestion = $database->getReference("Question/" . $gettemp['idquestion'])->getValue();
    if ($choice == $getQuestion['answer']) {
        $_SESSION['score'] = $getQuestion['score'] + $_SESSION['score'];
    }
    $_SESSION['number']++;
    $nextQuestion = $database->getReference("Temp_Quiz/" . $nis . "/" . $_SESSION['number'])->getValue();
    if ($nextQuestion > 0) {
        header("location:../student/quiz.php");
    } else {
        header("location:../student/result.php");
    }
}
if (isset($_POST['result'])) {
    $getExp = $database->getReference('exp/' . $_SESSION['nis'])->getValue();
    if ($getExp > 0) {
        $score = $getExp['exp'] + $_SESSION['score'];
        $postData = [
            'exp' => $score,
            'nis' => $_SESSION['nis']
        ];
        $postTemp = $database->getReference('exp/' . $_SESSION['nis'])->set($postData);
        if ($postTemp) {
            unset($_SESSION['score']);
            unset($_SESSION['number']);
            $delete_Result = $database->getReference('Temp_Quiz/' . $_SESSION['nis'])->remove();
            header("location:../student/class.php");
        }
    } else {
        $postData = [
            'exp' => $_SESSION['score'],
            'nis' => $_SESSION['nis']
        ];
        $postTemp = $database->getReference('exp/' . $_SESSION['nis'])->set($postData);
        if ($postTemp) {
            unset($_SESSION['score']);
            unset($_SESSION['number']);
            $delete_Result = $database->getReference('Temp_Quiz/' . $_SESSION['nis'])->remove();
            header("location:../student/class.php");
        }
    }
}
