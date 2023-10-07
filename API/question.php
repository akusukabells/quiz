<?php
session_start();
include('../connector/dbcon.php');

if (isset($_POST['goselect'])) {

    header("location:../CRUD/select_question.php");
}

if (isset($_POST['goadd'])) {
    $select = $_POST['select_question'];

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
    if ($select == 1) {
        header("location:../CRUD/question.php");
    } else {
        header("location:../CRUD/susunkata.php");
    }
}
if (isset($_POST['goadd1'])) {

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
if (isset($_POST['adddatasusunkata'])) {
    $idquestion = $_POST['idquestion'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $idlevel = $_POST['idlevel'];
    $score = $_POST['score'];
    $option = $_POST['member'];
    $postData = [
        'idquestion' => $idquestion,
        'multioption' => "true",
        'question' => $question,
        'answer' => $answer,
        'idlevel' => $idlevel,
        'score' => $score,
        'option' => $option,
    ];
    for ($i = 0; $i < $option; $i++) {
        $opsi = $_POST['option' . $i];
        if (!empty($opsi)) {
            $postDataOption = [
                'idquestion' => $idquestion,
                'option' => $opsi
            ];
            $postoptionA = $database->getReference("Option/" . $idquestion . "/" . $i + 1)->set($postDataOption);
        }
    }
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
    if ($answer == "A") {
        $jawab = $_POST['option_a'];
    } else if ($answer == "B") {
        $jawab = $_POST['option_b'];
    } else if ($answer == "C") {
        $jawab = $_POST['option_c'];
    } else {
        $jawab = $_POST['option_d'];
    }

    $postData = [
        'idquestion' => $idquestion,
        'multioption' => "false",
        'question' => $question,
        'answer' => $jawab,
        'idlevel' => $idlevel,
        'score' => $score
    ];

    $postDataOptionA = [
        'idquestion' => $idquestion,
        'option' => $option_a
    ];
    $postDataOptionB = [
        'idquestion' => $idquestion,
        'option' => $option_b
    ];
    $postDataOptionC = [
        'idquestion' => $idquestion,
        'option' => $option_c
    ];
    $postDataOptionD = [
        'idquestion' => $idquestion,
        'option' => $option_d
    ];

    $postoptionA = $database->getReference("Option/" . $idquestion . "/" . $option_a)->set($postDataOptionA);
    $postoptionB = $database->getReference("Option/" . $idquestion . "/" . $option_b)->set($postDataOptionB);
    $postoptionC = $database->getReference("Option/" . $idquestion . "/" . $option_c)->set($postDataOptionC);
    $postoptionD = $database->getReference("Option/" . $idquestion . "/" . $option_d)->set($postDataOptionD);
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
    $getresult = $database->getReference("Question/" . $_POST['goedit'])->getValue();
    if ($getresult['multioption'] == "false") {
        header("location:../CRUD/question.php");
    } else {
        header("location:../CRUD/susunkata.php");
    }
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
    if ($answer == "A") {
        $jawab = $option_a;
    } else if ($answer == "B") {
        $jawab = $option_b;
    } else if ($answer == "C") {
        $jawab = $option_c;
    } else {
        $jawab = $option_d;
    }
    $postData = [
        'idquestion' => $idquestion,
        'multioption' => "false",
        'question' => $question,
        'answer' => $jawab,
        'idlevel' => $idlevel,
        'score' => $score
    ];
    $postDataOptionA = [
        'idquestion' => $idquestion,
        'option' => $option_a
    ];
    $postDataOptionB = [
        'idquestion' => $idquestion,
        'option' => $option_b
    ];
    $postDataOptionC = [
        'idquestion' => $idquestion,
        'option' => $option_c
    ];
    $postDataOptionD = [
        'idquestion' => $idquestion,
        'option' => $option_d
    ];
    $delete_Result = $database->getReference('Option/' . $idquestion)->remove();
    $postoptionA = $database->getReference("Option/" . $idquestion . "/" . $option_a)->set($postDataOptionA);
    $postoptionB = $database->getReference("Option/" . $idquestion . "/" . $option_b)->set($postDataOptionB);
    $postoptionC = $database->getReference("Option/" . $idquestion . "/" . $option_c)->set($postDataOptionC);
    $postoptionD = $database->getReference("Option/" . $idquestion . "/" . $option_d)->set($postDataOptionD);
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
    $delete_Result = $database->getReference('Option/' . $idquestion)->remove();
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
if (isset($_POST['editsusunkata'])) {
    $_SESSION['status'] = "Coming Soon";
    header("location:../admin/question.php");
}
