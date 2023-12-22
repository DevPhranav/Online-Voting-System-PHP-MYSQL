<?php
include("../actions/connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
    $delete_id = mysqli_real_escape_string($con, $_POST["delete_id"]);

    // First, delete records from Votes table referencing the ElectionID
    $deleteVotesQuery = "DELETE FROM Votes WHERE ElectionID = $delete_id";
    if (mysqli_query($con, $deleteVotesQuery)) {

        // Then, delete records from Candidates table referencing the ElectionID
        $deleteCandidatesQuery = "DELETE FROM Candidates WHERE ElectionID = $delete_id";
        if (mysqli_query($con, $deleteCandidatesQuery)) {

            // Then, delete records from Positions table referencing the ElectionID
            $deletePositionsQuery = "DELETE FROM Positions WHERE ElectionID = $delete_id";
            if (mysqli_query($con, $deletePositionsQuery)) {

                // Now, delete the specific election record
                $deleteElectionQuery = "DELETE FROM Elections WHERE ElectionID = $delete_id";
                if (mysqli_query($con, $deleteElectionQuery)) {
                    // Redirect to prevent form resubmission
                    header("Location: {$_SERVER['PHP_SELF']}");
                    exit();
                } else {
                    echo "<script>alert('Error deleting election');</script>";
                }
            } else {
                echo "<script>alert('Error deleting positions');</script>";
            }
        } else {
            echo "<script>alert('Error deleting candidates');</script>";
        }
    } else {
        echo "<script>alert('Error deleting votes');</script>";
    }
}

// Fetch election titles and IDs from the database
$query = "SELECT electionid, Title FROM Elections";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Election</title>
    <link rel="stylesheet" type="text/css" href="../css/createElection.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
</head>
<body>

<div class="title">
     <h1 class="headtitle">Online Voting System</h1><h1 class="ap"> Admin Panel</h1>
     <div class="menus">

            <div><a href="./adminpanel.php">Home</a></div>
            <div><a href="./createElection.php">Election Section</a></div>
            <div><a href="./userlist.php">Users</a></div>
            <div><a href="../actions/logout.php">Logout</a></div>
        
    </div>
     </div>
    
    <div class="container">
        <div class="head">
        <h2>Conduct Election</h2>
        </div>
        <form action="../actions/process_election.php" method="POST" id="form-id">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>


            <!-- New input for Position Name -->
            <label for="position_name">Position Name:</label>
            <input type="text" id="position_name" name="position_name" required>

            <button type="submit" class="ce_button">Create Election</button>
        </form>
</div>
    


    
    <div class="election_section">
        <h1 class="ltitle">List of Elections</h1>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $electionid = $row["electionid"];
                $title = $row["Title"];

                echo '<div class="election-title-container" id="electionContainer_' . $electionid . '">';
                echo '<div class="election-title">' . $title . '</div>';
                echo '<div class="election-buttons">';
                echo '<form action="" method="POST" style="display:inline;">';
                echo '<input type="hidden" name="delete_id" value="' . $electionid . '">';
                echo '<button type="submit" onclick="return confirm(\'Are you sure you want to delete ' . $title . '?\')">Delete</button>';
                echo '</form>';
                echo '<form action="./editElection.php" method="POST">';
                echo '<button onclick="./editElection.php">Edit</button>';
                echo '<input type="hidden" name="electionID" value="'. $electionid . '" >';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No elections found.";
        }

        // Close the MySQL connection
        mysqli_close($con);

        ?>
         
    </div>
   

    <script>
        function editElection(title, id) {
            // Implement your edit logic here
            alert('Edit ' + title + ' with ID ' + id);
        }
    </script>
</body>
</html>