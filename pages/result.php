<?php 
 session_start();
 include("../actions/connect.php");
 $electionID = $_POST['elect'];
$electionTitle;

$query="select Title from elections where ElectionID = '$electionID'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)> 0){
  $row=mysqli_fetch_assoc($result);

 $electionTitle= $row["Title"];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>List of Candidates</title>
    <link rel="stylesheet" type="text/css" href="../css/result.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
</head>
<body>
    
   <div class="header">
        <form action="./dashboard.php" method="post">
        <input type="submit" class="button" value="Back to Dashboard">
    </form>

    <h1 style="padding-right: 20px;">Election Title|<?php echo "$electionTitle" ?></h1>
      
   </div>
    
    <?php
   
    

    // Query to select candidates, their votes, and photos
    $query = "SELECT c.cname, c.Photo, COUNT(v.VoteID) AS Votes
              FROM candidates c
              LEFT JOIN Votes v ON c.CandidateID = v.CandidateID
              WHERE c.ElectionID = '$electionID'
              GROUP BY c.CandidateID
              ORDER BY Votes DESC"; // Order candidates by votes in descending order

    $result = mysqli_query($con, $query);
       
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch the candidate with the highest votes

        // Display the winning candidate details in a separate div
        
        echo '<div class="winner">';
        echo '<h1 style="color:white">Result</h1>';
        echo '<h2 style="color:white">Winner:</h2>';
        echo '<div class="wcan">';
        echo '<img src="' . $row['Photo'] . '" alt="' . $row['cname'] . '">';
        echo '<div class="win_head">';
        echo '<p>Candidate name: ' . $row['cname'] . '</p>';
        echo '<p>Votes: ' . $row['Votes'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Display other candidates in descending order
       
        echo '<div class="remaining-candidates">';

         
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="candidate">';
            echo '<img src="' . $row['Photo'] . '" alt="' . $row['cname'] . '">';
            echo '<div class="details">';
            echo '<p>Candidate name: ' . $row['cname'] . '</p>';
            echo '<p>Votes: ' . $row['Votes'] . '</p>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo 'No candidates found.';
    }

    // Close the database connection
    mysqli_close($con);
    ?>

</body>
</html>
