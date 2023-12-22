<?php
include("../actions/connect.php");
$electionId=null;
$electionId = $_POST['ElectionID'];

$titleQuery = "SELECT Title from elections where ElectionID='$electionId'";
$titleresult = mysqli_query($con, $titleQuery);
$titledata = mysqli_fetch_assoc($titleresult);

// Query to fetch the number of positions
$positionsQuery = "SELECT COUNT(*) AS position_count FROM Positions WHERE ElectionID = '$electionId'";

// Query to fetch the number of candidates
$candidatesQuery = "SELECT COUNT(*) AS candidate_count FROM Candidates WHERE ElectionID = '$electionId'";

// Query to fetch the number of voters
$votersQuery = "SELECT COUNT(*) AS voter_count FROM Users WHERE Role = 'Voter' OR Role = 'Candidate'";

// Query to fetch the number of voted voters for the particular election
$votedVotersQuery = "SELECT COUNT(DISTINCT UserID) AS voted_voter_count FROM Votes WHERE ElectionID = '$electionId'";

// Execute the queries and store the results
$positionsResult = mysqli_query($con, $positionsQuery);
$candidatesResult = mysqli_query($con, $candidatesQuery);
$votersResult = mysqli_query($con, $votersQuery);
$votedVotersResult = mysqli_query($con, $votedVotersQuery);

// Fetch the data from query results
$positionsData = mysqli_fetch_assoc($positionsResult);
$candidatesData = mysqli_fetch_assoc($candidatesResult);
$votersData = mysqli_fetch_assoc($votersResult);
$votedVotersData = mysqli_fetch_assoc($votedVotersResult);

// Query to fetch candidate names and their votes
$candidateVotesQuery = "SELECT c.cname, COUNT(v.CandidateID) AS Votes 
                        FROM Candidates c
                        LEFT JOIN Votes v ON c.CandidateID = v.CandidateID
                        WHERE c.ElectionID = '$electionId'
                        GROUP BY c.cname";


$candidateVotesResult = mysqli_query($con, $candidateVotesQuery);

$candidateNames = [];
$candidateVotes = [];

while ($row = mysqli_fetch_assoc($candidateVotesResult)) {
    $candidateNames[] = $row['cname'];
    $candidateVotes[] = $row['Votes'];
}

// Generate random candidate names and vote values for testing


// // Generate 10 random candidates with random vote values
// for ($i = 1; $i <= 10; $i++) {
//     $candidateNames[] = "Candidate " . $i; // Replace with your naming scheme
//     $candidateVotes[] = rand(0, 20); // Generate random vote values (0 to 100)
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/electionpanel.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo+Play&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
</head>
<body>
<div class="etitle">
        <p>ELECTION TITLE| <?php echo $titledata['Title'] ?></p>
    </div>
<div class="titles">
     <h1 class="headtitle">Online Voting System</h1><h1 class="ap"> Admin Panel</h1>
     <div class="menus">

            <div><a href="./adminpanel.php">Home</a></div>
            <div><a href="./createElection.php">Election Section</a></div>
            <div><a href="./userlist.php">Users</a></div>
            <div><a href="../actions/logout.php">Logout</a></div>
        
    </div>
     </div>
    
    <div class="main-content">
        <div class="info-box">
            No. of Positions<br>
            <span class="info-value" id="positionCount"><?php echo $positionsData['position_count']; ?></span>
        </div>
        <div class="info-box">
            No. of Candidates<br>
            <span class="info-value" id="candidateCount"><?php echo $candidatesData['candidate_count']; ?></span>
        </div>
        <div class="info-box">
            No. of Voters<br>
            <span class="info-value" id="voterCount"><?php echo $votersData['voter_count']; ?></span>
        </div>
        <div class="info-box">
            No. of Voted Voters<br>
            <span class="info-value" id="votedCount"><?php echo $votedVotersData['voted_voter_count']; ?></span>
        </div>
    </div>
    <div class="bottom-section">
        <canvas id="barChart" width="400" height="200"></canvas>
    </div>
    <script>
        var ctx = document.getElementById("barChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($candidateNames); ?>,
        datasets: [{
            label: 'Votes',
            data: <?php echo json_encode($candidateVotes); ?>,
            backgroundColor: ["#4CAF50", "#FFFF66", "#deffc9", "#FF5733", "#6495ED", "#FFD700", "#8A2BE2", "#32CD32", "#FF7F50", "#00CED1"]
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    stepSize: 1,
                    precision: 0
                },
                gridLines: {
                    display: true // Remove y-axis grid lines
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false // Remove x-axis grid lines
                }
            }]
        },
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 10
            }
        },
        // Change the background color of the chart
        elements: {
            rectangle: {
                backgroundColor: '#DFE6E6' // Change this color to your desired background color
            }
        }
    }
});

</script>


</body>
</html>
