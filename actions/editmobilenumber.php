<?php
session_start();
include('connect.php');

if (isset($_POST['mobile'])) {
    $newMobile = $_POST['mobile'];
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
    else{
        echo "<script>alert('No Changes in Mobile number.'); window.location='../pages/profile.php';</script>";
    }
}

?>