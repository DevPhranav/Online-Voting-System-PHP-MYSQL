<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["election_id"])) {
    // Include your database connection
    include("../actions/connect.php");

    // Get the updated data from the form
    $election_id = mysqli_real_escape_string($con, $_POST["election_id"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $start_date = mysqli_real_escape_string($con, $_POST["start_date"]);
    $end_date = mysqli_real_escape_string($con, $_POST["end_date"]);

    // Update the Elections table with the new data
    $updateQuery = "UPDATE Elections SET Title = '$title', Description = '$description', 
                    Start_Date = '$start_date', End_Date = '$end_date' WHERE ElectionID = $election_id";

    if (mysqli_query($con, $updateQuery)) {
        // If the update was successful, redirect back to the edit page with a success message
        header("Location: ../pages/createElection.php?election_id=$election_id&success=1");
        exit();
    } else {
        // If the update fails, redirect back to the edit page with an error message
        header("Location: ../pages/createElection.php?election_id=$election_id&error=1");
        exit();
    }
} else {
    // If the form wasn't submitted properly, redirect back to the edit page
    header("Location: ../pages/createElection.php?error=1");
    exit();
}
?>
