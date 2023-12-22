<?php
session_start();
include('connect.php');

if (isset($_POST['username'])) {
    $newUsername = $_POST['username'];
    $data = $_SESSION['data'];

    if (!empty($newUsername) && $newUsername != $data['username']) {
        $id = $data['UserID'];
        $sql = "UPDATE `Users` SET username='$newUsername' WHERE UserID=$id";

        if (mysqli_query($con, $sql)) {
            $_SESSION['data']['Username'] = $newUsername;
             echo "<script>alert('Username updateds successfully.'); window.location='../pages/profile.php';</script>";
        } else {
            echo "<script>alert('Failed to update username: " . mysqli_error($con) . "'); window.location='../pages/profile.php';</script>";
        }
    }
}

if (isset($_POST['Mobile'])) {
    $newMobile = $_POST['Mobile'];
    $data = $_SESSION['data'];

    if (!preg_match('/^[0-9]{10}$/', $newMobile)) //Perl-Compatible Regular Expression Match
    {  
        echo "<script>alert('Enter a valid 10-digit mobile number.'); window.location='../pages/profile.php';</script>";
    } elseif ($newMobile != $data['Mobile']) {
        $id = $data['UserID'];
        $sql = "UPDATE `users` SET Mobile='$newMobile' WHERE UserID=$id";

        if (mysqli_query($con, $sql)) {
            $_SESSION['data']['Mobile'] = $newMobile;
            echo "<script>alert('Mobile number updated successfully.'); window.location='../pages/profile.php';</script>";
        } else {
            echo "<script>alert('Failed to update mobile number: " . mysqli_error($con) . "'); window.location='../pages/profile.php';</script>";
        }
    }
}


if (isset($_POST['npassword'])) {
    $oldPassword = $_POST['opassword'];
    $newPassword = $_POST['npassword'];
    $data = $_SESSION['data'];

    if ($oldPassword == $data['Password']) { 
        $id = $data['UserID'];
        $sql = "UPDATE `users` SET password='$newPassword' WHERE UserID=$id";

        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Password updated successfully.'); window.location='../pages/profile.php';</script>";
        } else {
            echo "<script>alert('Failed to update password: " . mysqli_error($con) . "'); window.location='../pages/profile.php';</script>";
        }
    } else {
        echo "<script>alert('Old password is incorrect.'); window.location='../pages/profile.php';</script>";
    }
}
