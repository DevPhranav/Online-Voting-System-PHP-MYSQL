<?php
include('connect.php');

$username = $_POST['username'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$std = $_POST['std'];
$electionID = $_POST['election'];


//hashing the password 
$hashed_password=password_hash($password,PASSWORD_DEFAULT);

// Check if mobile number is already registered
$sql = "select mobile from users where mobile = $mobile";
$result = mysqli_query($con, $sql);
$r = mysqli_num_rows($result);

if ($r == 0) {
    $randnumber = rand(2555, 65555);

    // Start a transaction
    mysqli_begin_transaction($con);

    // Define the path where you want to move the uploaded image
    $upload_directory = '../uploads/';
    $image_path = $upload_directory . $image;

    // Insert into users table , Random number act as a id,for table relationship we do like this 
    $sql1 = "insert into `users`(UserID, Username, Mobile, Password, Photo, Role) values ('$randnumber', '$username', '$mobile', '$hashed_password', '$image_path', '$std')";
    $result1 = mysqli_query($con, $sql1);

    // Insert into candidates table if std is candidate
    if ($std === "candidate") {
        $sql2 = "insert into `candidates`(ElectionID, UserID, cname, Photo, status) values ('$electionID', '$randnumber', '$username', '$image_path', 0)";
        $result2 = mysqli_query($con, $sql2);
    }

    // Move the uploaded image to the "uploads" folder
    if (move_uploaded_file($tmp_name, $image_path)) {
        // Commit the transaction if both queries were successful and image is moved
        if ($result1 && ($std !== "candidate" || isset($result2))) {
            mysqli_commit($con);
            echo '<script>
                     window.location="../redirects/message.php";
                  </script>';
        } else {
            // Rollback the transaction if any query fails
            mysqli_rollback($con);
            echo '<script>
                    alert("Error occurred during registration.");
                    window.location="../pages/registration.php";
                  </script>';
        }
    } else {
        // Image upload failed
        mysqli_rollback($con);
        echo '<script>
                alert("Image upload failed.");
                window.location="../pages/registration.php";
              </script>';
    }
} else {
    echo '<script>
            alert("Mobile number : '. $mobile .' is already registered !");
            window.location="../pages/registration.php";
          </script>';
}
?>
