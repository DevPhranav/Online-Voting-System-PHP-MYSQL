<?php
session_start();
include('connect.php');

if (isset($_POST['username'])) {
    $newUsername = $_POST['username'];
    $data = $_SESSION['data'];

    if (!empty($newUsername) && $newUsername != $data['Username']) {
        $id = $data['UserID'];
        $sql = "UPDATE `Users` SET username='$newUsername' WHERE UserID=$id";

        if (mysqli_query($con, $sql)) {
            $_SESSION['data']['Username'] = $newUsername;
            echo "<script>alert('Username updated successfully.'); window.location='../pages/profile.php';</script>";
        } else {
            echo "<script>alert('Failed to update username: " . mysqli_error($con) . "'); window.location='../pages/profile.php';</script>";
        }
    }
}
?>