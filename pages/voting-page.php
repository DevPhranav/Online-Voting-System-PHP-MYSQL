<?php
session_start();
include("../actions/connect.php");

if(!isset($_SESSION['UserID'])) {
    header('location:../');
}
else
{
    $_SESSION['ElectionID']=null;
    $_SESSION['cgroups']=null;
}

$data = $_SESSION['data'];

// Check if 'title_data' is set in $_POST(is data received), otherwise provide a default value
$title_data = isset($_POST['title_data']) ? $_POST['title_data'] : 'Unknown Title';

// Check if ElectionID is set in $_POST(is data received) , otherwise provide a default value
$_SESSION['ElectionID'] = isset($_POST['elec']) ? $_POST['elec'] : '';

// Check for if user is already voted or not 
$checkQuery = "SELECT * FROM votes WHERE UserID = '$data[UserID]' AND ElectionID = '$_SESSION[ElectionID]'";
$result = mysqli_query($con, $checkQuery);

if(mysqli_num_rows($result) == 0) {
    $_SESSION['vote_status'] = 0;
} else {
    $_SESSION['vote_status'] = 1;
}
//get the vote status of user and get all the candidate to display 
$rowcount = $_SESSION['vote_status'];

$sql = "SELECT CandidateID, cname, UserID, Photo, ElectionID FROM candidates WHERE ElectionID = '$_SESSION[ElectionID]'";

$resultgroup = mysqli_query($con, $sql);

if(mysqli_num_rows($resultgroup) > 0) {
    $cgroups = mysqli_fetch_all($resultgroup, MYSQLI_ASSOC);
    $_SESSION['cgroups'] = $cgroups;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose your Class rep</title>
    <link rel="stylesheet" href="../css/voting-page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
</head>
<body>
<div class="main-content">
    <h1>Choose Your <?php echo $title_data ?></h1>
    <form action="./dashboard.php" method="post">
        <input type="submit" class="gbutton" value="Back to Dashboard" onclick="backToDashboard()">
    </form>

    <script>
        function backToDashboard() {
            window.location.href = "./dashboard.php";
        }
    </script>

    <?php
    if ($rowcount == 1) {
        ?>
        <h1>You already Voted !</h1>

        <img src="../images/thankvote.jpg" alt="Thanks for Voting!" class="thanks" style="border-radius:20px;">
       
        <?php
    } else {
        if (isset($_SESSION['cgroups'])) {
            $groups = $_SESSION['cgroups'];
            foreach ($groups as $group) {
                ?>
                <div class="candidate">
                    <div class="candidate-details">
                        <h3>Name: <?php echo $group['cname'] ?></h3>
                    </div>
                    <?php
                    if (isset($group['Photo']) && file_exists("../uploads/" . $group['Photo'])) {
                        $imagePath = "../uploads/" . $group['Photo'];
                        echo '<img src="' . $imagePath . '" alt="Candidate" class="candidate-image">';
                    } else {
                        echo 'Image not found or path is incorrect.';
                    }
                    ?>

                    <form action="../actions/voting.php" method="post">
                        <input type="hidden" name="UserID" value="<?php echo $data['UserID'] ?>">
                        <input type="hidden" name="ElectionID" value="<?php echo $group['ElectionID'] ?>">
                        <input type="hidden" name="CandidateID" value="<?php echo $group['CandidateID'] ?>">

                        <?php
                        if ($rowcount == 1) {
                            ?>
                            <button class="vote-button" style="opacity:50%" disabled>Voted</button>
                            <?php
                        } else {
                            ?>
                            <button class="vote-button" type="submit">Vote</button>
                            <?php
                        }
                        ?>
                    </form>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="container">
                <p>No groups to display</p>
            </div>
            <?php
        }
    }
    ?>
</div>
</body>
</html>
