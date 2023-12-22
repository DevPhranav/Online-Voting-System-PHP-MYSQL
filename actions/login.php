<?php
session_start();
include('connect.php');

$mobile = $_POST['mobile'];
$password = $_POST['password'];

// Check if the mobile is registered
$sql = "SELECT * FROM `users` WHERE Mobile='$mobile'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);

    // Verify the entered password against the hashed password from the database
    if (password_verify($password, $userData['Password'])) {
        // Passwords match - user authenticated

        // Store user data in session variables
        $_SESSION['data'] = $userData;
        $_SESSION['UserID'] = $userData['UserID'];
        $_SESSION['vote_status'] = 0;

        // Redirect to the dashboard
        echo '<script>
            window.location="../pages/dashboard.php";
        </script>';
    } else {
        // Passwords don't match - invalid credentials
        echo '<script>
            alert("Invalid credentials");
            window.location="../";
        </script>';
    }
} else {
    // No user found with the provided mobile number
    echo '<script>
        alert("Invalid credentials");
        window.location="../";
    </script>';
}
?>
