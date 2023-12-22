 <?php 
 session_start();
 $data = $_SESSION['data'];
// Check user authentication
if (!isset($_SESSION['UserID'])) {
    header('location:../');
}

// Include the connection file and start the session
include("../actions/connect.php");



$start_date;
$end_date;

// Fetch all elections data
$sql = "SELECT * FROM elections";
$result = mysqli_query($con, $sql);
$elections = mysqli_fetch_all($result, MYSQLI_ASSOC);
$_SESSION['egroups']=$elections;

function getElectionStatus($start_date, $end_date) {
    $current_date = date('Y-m-d'); // Get current date

    if ($current_date < $start_date) {
        return "Upcoming";
    } elseif ($current_date >= $start_date && $current_date <= $end_date) {
        return "Ongoing";
    } else {
        return "Ended";
    }
}

// Loop through elections data
foreach ($elections as $election) {
    $start_date = $election['Start_Date'];
    $end_date = $election['End_Date'];
    $electionID = $election['ElectionID'];
    $election_status = getElectionStatus($start_date, $end_date);

    // if ($election_status === 'Ended') {
    //     // Remove related data from child tables
    //     $delete_votes_query = "DELETE FROM votes WHERE ElectionID = $electionID";
    //     mysqli_query($con, $delete_votes_query);

    //     $delete_candidates_query = "DELETE FROM candidates WHERE ElectionID = $electionID";
    //     mysqli_query($con, $delete_candidates_query);

    //     $delete_positions_query = "DELETE FROM positions WHERE ElectionID = $electionID";
    //     mysqli_query($con, $delete_positions_query);

    //     // Remove from the 'elections' table
    // }

    $sql="UPDATE  elections SET status ='$election_status' WHERE  ElectionID='$electionID' ;";
    mysqli_query( $con, $sql);

}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Online Voting System Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/editprofile.css">
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
</head>
<body>
    
<div class="container">
<div class="title">
     <h1 class="headtitle">Online Voting System</h1><h1 class="ap"> Dashboard</h1>
     <div class="menus">

            <div><a href="./dashboard.php">Home</a></div>
            <div><a href="./Profile.php">Profile</a></div>
            <div><a href="../actions/logout.php">Logout</a></div>
        
    </div>
     </div>
    <div class="side-panel">
   
        <div class="profile-info">
            <div class="image">
            <img src="../uploads/<?php echo $data['Photo'] ?>" alt="User Profile">
            </div>
            
            <div class="username tain">
            <p>Username: <?php echo $data['Username']; ?></p>
            </div>
           
            <div class="mobile_no tain">
            <p>Mobile Number: <?php echo $data['Mobile']; ?></p>
            </div>
            
        </div>
    </div>
    <div class="main-content">
    
        
    <div class="form-section">
            <h3>Edit Username</h3>
            <form action="../actions/editusername.php" method="post">
                <div class="form-group">
                    <label for="username">New Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $data['Username']; ?>" placeholder="Enter your new username">
                </div>
                <button class="ebutton" type="submit">Save Username</button>
            </form>
        </div>

 
        <div class="form-section">
            <h3>Edit Mobile Number</h3>
            <form action="../actions/editmobilenumber.php" method="post">
                <div class="form-group">
                    <label for="mobile">New Mobile Number</label>
                    <input type="tel" id="mobile" name="mobile" value="<?php echo $data['Mobile']; ?>" placeholder="Enter your new mobile number">
                </div>
                <button class="ebutton" type="submit">Save Mobile Number</button>
            </form>
        </div>

        <div class="form-section">
            <h3>Change Password</h3>
            <form action="../actions/changepassword.php" method="post">
                <div class="form-group">
                    <label for="opassword">Old Password</label>
                    <input type="password" id="opassword" name="opassword" placeholder="Enter your old password">
                </div>
                <div class="form-group">
                    <label for="npassword">New Password</label>
                    <input type="password" id="npassword" name="npassword" placeholder="Enter your new password">
                </div>
                <button class="ebutton" type="submit">Change Password</button>
            </form>
        </div>
     
       

    </div>
    
</div>

</body>
</html>

