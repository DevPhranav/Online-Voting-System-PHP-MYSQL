<?php
session_start();
include('connect.php');

$UserID = $_POST["UserID"];
$ElectionID = $_POST["ElectionID"];
$CandidateID = $_POST["CandidateID"];

$data = $_SESSION['data'];



if ( $_SESSION['vote_status']==0) {
    // The user has not voted for this election, proceed with the INSERT operation
    $insertQuery = "INSERT INTO votes (UserID, ElectionID, CandidateID) VALUES ('$UserID', '$ElectionID', '$CandidateID')";

    if (mysqli_query($con, $insertQuery)) {
        echo '<script>
        alert("Voting successful!!");
        window.location="../pages/dashboard.php";
        </script>';
    }
} else {
    // The user has already voted for this election
    echo '<script>
    alert("You already voted for this election!");
    window.location="../pages/dashboard.php";
    </script>';
}
?>
