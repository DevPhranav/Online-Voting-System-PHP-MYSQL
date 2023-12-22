<?php 
session_start();
                include("../actions/connect.php");
                          $sql="SELECT * from elections";
                          $result=mysqli_query($con,$sql);
                          $groups=mysqli_fetch_all($result,MYSQLI_ASSOC);
                          $_SESSION['egroups']=$groups;
                        ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/adminPanel.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo+Play&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="../title-icon.png">  
    <title>Admin Panel</title>
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
    
    <div class="content">
      
    <div class="election_list">
    <?php
    if (isset($_SESSION['egroups']) && is_array($_SESSION['egroups'])) {
        foreach ($_SESSION['egroups'] as $election) {
            $electionID = $election['ElectionID'];
            $title_data = $election['Title'];
    ?>
    <div class="election">
    <h2><?php echo $title_data; ?></h2>
        <div class="election_button">
            <form action="./election_board.php" method="post">
                <input type="hidden" name="ElectionID" value="<?php echo $electionID; ?>">
                <input type="submit" class="ebutton" value="Click here ">
            </form>
        </div>
        
    </div>
    <?php
        }
    } else {
        echo "No elections found in the session.";
    }
    ?>
</div>

      

    </div>



</body>
</html>
