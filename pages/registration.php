<?php 
    include('../actions/connect.php');
   
    $sql = "select ElectionID, Title,status from elections";
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo+Play&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/registration.css">
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="heading">
        <h1 id="title">Online Voting System</h1>
        </div>
            <div class="signup ">
            <h2 class="signup_head">SignUp</h2>
            <form action="../actions/register.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="input-container">
        <label for="username">Username</label>
        <input type="text" placeholder="Username" name="username" id="username" required>
    </div>
    <div class="input-container">
        <label for="mobile">Mobile number</label>
        <input type="text" placeholder="Mobile number" name="mobile" id="mobile" maxlength="10" minlength="10" required>
    </div>
    <div class="input-container">
        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" id="password" required>
    </div>
    <div class="input-container">
        <label for="cpassword">Confirm Password</label>
        <input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" required style="margin: 0">
        <span id="passwordError"> </span>
    </div>
    <div class="input-container">
        <label  for="photo">Upload Photo</label><br>
        <input type="file" name="photo" class="photo" required>
    </div>
    <div class="input-container">
        <label for="user-type">Select Role</label>
        <select name="std" id="user-type" class="options" required>
            <option value="voter" selected>Voter</option>
            <option value="candidate">Candidate</option>
        </select>
    </div>

                <div class="input-container candidate-info" id="election-info" style="display: none;">
                    <select name="election" class="options"id="elec" >
                    <option value="">Select Election</option>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result) ) {
                                if( $row["status"] !="Ended")
                                echo "<option value='" . $row['ElectionID'] . "'>" . $row['Title'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="signupbutton">Register</button>
                <p>Already have an account? <a href="../index.php">Sign In</a></p>
            </form>
        </div>
    </div>
    

    <script src="../scripts/validateForm.js"></script>


</body>
</html>
