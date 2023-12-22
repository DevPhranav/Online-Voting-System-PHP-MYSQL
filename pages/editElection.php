<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Election</title>
    <link rel="stylesheet" href="../css/createElection.css">
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
</head>
<body style="display:flex;justify-content:center;align-items:center;height:80vh;">
<form action="./createElection.php" method="post" id="back">
                <input type="submit" class="ce_button button" value="Back to Election Section" style="border: 1px solid white;">
            </form>
    
    <div class="container e_container edit_election">
        <h2>Edit Election</h2>
        <?php
        include("../actions/connect.php");
        // Assuming $con is your database connection
        if (isset($_POST['electionID'])) {
            $election_id = $_POST['electionID'];
            // Fetch existing election details from the database
            $query = "SELECT * FROM Elections WHERE ElectionID = $election_id";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $title = $row['Title'];
                $description = $row['Description'];
                $start_date = $row['Start_Date'];
                $end_date = $row['End_Date'];

              
                // Display form with existing data populated in fields
                echo '<form action="../actions/election_update.php" method="POST" id="form-id">';
                echo '<input type="hidden" name="election_id" value="' . $election_id . '">';

                echo '<label for="title">Title:</label>';
                echo '<input type="text" id="title" name="title" value="' . $title . '" required>';
                
                echo '<label for="description">Description:</label>';
                echo '<textarea id="description" name="description" required>' . $description . '</textarea>';

                echo '<label for="start_date">Start Date:</label>';
                echo '<input type="date" id="start_date" name="start_date" value="' . $start_date . '" required>';

                echo '<label for="end_date">End Date:</label>';
                echo '<input type="date" id="end_date" name="end_date" value="' . $end_date . '" required>';

                // Add other fields here if needed
                echo '<div class="btns">';
                echo '<button type="submit" class="ce_button">Save Changes</button>';
               
                echo '</div>';
                echo '</form>';
                
            } else {
                echo "Election not found.";
            }
        } else {
            echo "No election ID provided.";
        }
        ?>


    </div>
</body>
</html>
