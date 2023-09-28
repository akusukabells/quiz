<?php
session_start();
include('../connector/dbcon.php');

if (isset($_POST['resetstudent'])) {
    $oldpassword = sha1($_POST['oldpassword']);
    $newpassword = sha1($_POST['newpassword']);
    $confirmpassword = sha1($_POST['confirmpassword']);

    if ($newpassword == $confirmpassword) {
        $nis = $_SESSION['nis'];
        $getData = $database->getReference('Users/' . $nis)->getValue();
        if ($getData['password'] == $oldpassword) {
            $postData = [
                'nis' => $nis,
                'name' => $getData['name'],
                'role' => $getData['role'],
                'password' => $newpassword
            ];
            $postRef_result = $database->getReference("Users/" . $nis)->set($postData);
            if ($postRef_result) {
                $_SESSION['status'] = "Successfully Change Password";
                header("location:../student/changepassword.php");
            } else {
                $_SESSION['status'] = "Failed Change Password";
                header("location:../student/changepassword.php");
            }
        } else {
            //password lama gak sama
            $_SESSION['notif'] = "invalid old password";
            header("location:../student/changepassword.php");
        }
    } else {
        //new password dan confirm password tidak sama
        $_SESSION['notif'] = "invalid confirm password";
        header("location:../student/changepassword.php");
    }
}

if (isset($_POST['resetadmin'])) {
    $oldpassword = sha1($_POST['oldpassword']);
    $newpassword = sha1($_POST['newpassword']);
    $confirmpassword = sha1($_POST['confirmpassword']);

    if ($newpassword == $confirmpassword) {
        $nis = $_SESSION['nis'];
        $getData = $database->getReference('Users/' . $nis)->getValue();
        if ($getData['password'] == $oldpassword) {
            $postData = [
                'nis' => $nis,
                'name' => $getData['name'],
                'role' => $getData['role'],
                'password' => $newpassword
            ];
            $postRef_result = $database->getReference("Users/" . $nis)->set($postData);
            if ($postRef_result) {
                $_SESSION['status'] = "Successfully Change Password";
                header("location:../admin/changepassword.php");
            } else {
                $_SESSION['status'] = "Failed Change Password";
                header("location:../admin/changepassword.php");
            }
        } else {
            //password lama gak sama
            $_SESSION['notif'] = "invalid old password";
            header("location:../admin/changepassword.php");
        }
    } else {
        //new password dan confirm password tidak sama
        $_SESSION['notif'] = "invalid confirm password";
        header("location:../admin/changepassword.php");
    }
}

if (isset($_POST['resetpassword'])) {
    $nis = $_POST['oldpassword'];
    $getData = $database->getReference("Users/" . $nis)->getValue();
    if ($getData > 0) {
        $postData = [
            'nis' => $getData['nis'],
            'name' => $getData['name'],
            'role' => $getData['role'],
            'password' => sha1($getData['nis'])
        ];
        $postRef_result = $database->getReference("Users/" . $nis)->set($postData);
        if ($postRef_result) {
            $_SESSION['status'] = "Successfully Reset Password";
            header("location:../admin/resetpassword.php");
        } else {
            $_SESSION['status'] = "Failed Reset Password";
            header("location:../admin/resetpassword.php");
        }
    } else {
        //gak ada
        $_SESSION['notif'] = "NIS tidak ditemukan";
        header("location:../admin/resetpassword.php");
    }
}
