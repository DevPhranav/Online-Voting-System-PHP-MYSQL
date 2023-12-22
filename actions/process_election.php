<?php
include("./connect.php");

$title = $_POST['title'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$positionTitle=$_POST['position_name'];

$checktitle = "SELECT Title,status FROM elections WHERE Title = '$title'";
$checkResult = mysqli_query($con, $checktitle);
$checkdata = mysqli_fetch_assoc($checkResult);

if ($checkResult) {
     
        $sql = "INSERT INTO elections(Title, Description, Start_Date, End_Date) VALUES ('$title','$description','$start_date','$end_date')";
        $result = mysqli_query($con, $sql);

        // ... (your existing code for insertion of new election data)

// After successfully inserting new election data
if ($result) {
    // Get the last inserted election ID
    $lastInsertedID = mysqli_insert_id($con);

    // Fetch the Start_Date and End_Date of the newly inserted election
    $fetchDateQuery = "SELECT Start_Date, End_Date FROM Elections WHERE ElectionID = $lastInsertedID";
    $dateResult = mysqli_query($con, $fetchDateQuery);
    $row = mysqli_fetch_assoc($dateResult);
    $start_date = $row['Start_Date'];
    $end_date = $row['End_Date'];

    // Determine the status based on the current date and retrieved Start_Date and End_Date
    $current_date = date('Y-m-d'); // Get current date
    if ($current_date < $start_date) {
        $status = "Upcoming";
    } elseif ($current_date >= $start_date && $current_date <= $end_date) {
        $status = "Ongoing";
    } else {
        $status = "Ended";
    }

    // Update the Status column in the Elections table for the inserted election
    $updateStatusQuery = "UPDATE Elections SET Status = '$status' WHERE ElectionID = $lastInsertedID";
    if (mysqli_query($con, $updateStatusQuery)) {
        // Status updated successfully
    } else {
        echo "<script>alert('Error updating election status');</script>";
    }
}
        // Get the ID of the newly inserted election
        $electionID = $lastInsertedID;

        // Insert data into Positions table
        $positionDescription = "Some Position Description"; // You can replace this with the actual position description

        $positionSql = "INSERT INTO Positions(ElectionID, Title, Description) VALUES ('$electionID', '$positionTitle', '$positionDescription')";
        $positionResult = mysqli_query($con, $positionSql);

        if ($positionResult) {
            echo '<script>
                alert("Election and Position created successfully!");
                window.location="../pages/createElection.php";
            </script>';
        } else {
            echo "Error inserting data into Positions table: " . mysqli_error($con);
        }
    
} else {
    echo "Error: " . mysqli_error($con);
}
?>
