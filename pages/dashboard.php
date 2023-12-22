<?php

// Include the connection file and start the session
include("../actions/connect.php");
session_start();

// Check user authentication
if (!isset($_SESSION['UserID'])) {
    header('location:../');
}
$data = $_SESSION['data'];
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
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
</head>
<body>

<div class="title">
     <h1 class="headtitle">Online Voting System</h1><h1 class="ap"> Dashboard</h1>
     <div class="menus">

            <div><a href="./dashboard.php">Home</a></div>
            <div><a href="./Profile.php">Profile</a></div>
            <div><a href="../actions/logout.php">Logout</a></div>
        
    </div>
     </div>
    <div class="content">
        <?php
        if (isset($_SESSION['egroups']) && is_array($_SESSION['egroups'])) {
            foreach ($_SESSION['egroups'] as $election) {
                $electionID = $election['ElectionID'];
                $title_data = $election['Title'];
                $start_date = $election['Start_Date']; 
                $end_date = $election['End_Date']; 
                $election_status = getElectionStatus($start_date, $end_date);
        ?>
       <div class="election">
        <div class="date">
         <p>Start Date : <?php echo "$start_date" ?></p><span></span>
         <p>End Date:  <?php echo "$end_date" ?></p>
           </div>
 
      
        <h1 class="etitle"><?php echo $title_data; ?> </h1>
        <p class="status">Status: <?php echo $election_status; ?></p>
        <?php if ($election_status === 'Ended') { ?>
        <form action="./result.php" method="post">
            <input type="hidden" name="elect" value="<?php echo $electionID?>">
            <input type="submit" value="View Result" class="ebutton">
        </form>
    <?php } ?>
        
        <form action="./voting-page.php" method="post">
            <input type="hidden" name="elec" value="<?php echo $electionID; ?>">
            <input type="hidden" name="title_data" value="<?php echo $title_data; ?>">
            <?php if ($election_status === 'Ongoing') { ?>
            <input type="submit" value="Choose Your <?php echo $title_data; ?>" class="ebutton"id="submitButton_<?php echo $electionID; ?>">

            <?php }else if( $election_status === 'Ended'){?>
                   
        <?php }else { ?>
           <br> <input type="button" class="button"  value="Choose Your <?php echo $title_data; ?>" class="button-68" id="submitButton_<?php echo $electionID; ?>" onclick="showAlert()">
           
        <?php } ?>
        </form>

        
    </div>
    
        <?php
            }
        } else {
            echo "No elections found in the session.";
        }
        ?>
    </div>
<script>
    function showAlert() {
        alert("Election has not yet started.");
    }

    // Handle click on disabled buttons to prevent default form submission
    document.addEventListener("DOMContentLoaded", function () {
        <?php foreach ($_SESSION['egroups'] as $election) { ?>
            const disabledButton_<?php echo $election['ElectionID']; ?> = document.getElementById("submitButton_<?php echo $election['ElectionID']; ?>");
            if (disabledButton_<?php echo $election['ElectionID']; ?>.hasAttribute("disabled")) {
                disabledButton_<?php echo $election['ElectionID']; ?>.addEventListener("click", function (event) {
                    event.preventDefault(); // Prevent default form submission
                    showAlert(); // Show alert for disabled button click
                });
            }
        <?php } ?>
    });
</script>
</body>
</html>
