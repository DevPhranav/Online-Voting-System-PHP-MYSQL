<?php
session_start();
include('connect.php');

if (isset($_POST['npassword'])) {
    $oldPassword = $_POST['opassword'];
    $newPassword = $_POST['npassword'];
    $data = $_SESSION['data'];

    if ($oldPassword == $data['Password']) { 
        $id = $data['UserID'];
        $sql = "UPDATE `users` SET Password='$newPassword' WHERE UserID=$id";

        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Password updated successfully.'); window.location='../pages/profile.php';</script>";
            $_SESSION['data']['Password'] = $newPassword;
        } else {
            echo "<script>alert('Failed to update password: " . mysqli_error($con) . "'); window.location='../pages/profile.php';</script>";
        }
    } else {
        echo "<script>alert('Old password is incorrect.'); window.location='../pages/profile.php';</script>";
    }
}

?>