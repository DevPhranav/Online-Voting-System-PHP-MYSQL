<?php
include("../actions/connect.php");

// Default SQL query to fetch all users
$sql = "SELECT UserID, Username, Mobile, Role, Photo FROM users";

// Check if search term is provided via POST
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    // Modify SQL query to include search functionality based on Username, Mobile, or Role
    $sql .= " WHERE Username LIKE '%$search%' OR Mobile LIKE '%$search%' OR Role LIKE '%$search%'";
}

// Execute the query
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>List of Users</title>
    <link rel="stylesheet" type="text/css" href="../css/result.css">
    <link rel="stylesheet" type="text/css" href="../css/adminPanel.css">
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
    <!-- Your other CSS and fonts -->
    <link rel="stylesheet" type="text/css" href="../css/userlist.css"> <!-- Link to your external CSS file -->
    <style>
        /* Additional CSS styles for user photos */
        .user-img img {
            width: 50px; /* Adjust width as needed */
            height: 50px; /* Adjust height as needed */
        }
    </style>
</head>
<body>
<div class="title">
     <h1 class="headtitle" style="color:white">Online Voting System</h1><h1 class="ap" style="color:white"> Admin Panel</h1>
     <div class="menus">

            <div><a href="./adminpanel.php">Home</a></div>
            <div><a href="./createElection.php">Election Section</a></div>
            <div><a href="./userlist.php">Users</a></div>
            <div><a href="../actions/logout.php">Logout</a></div>
        
    </div>
     </div>
    
    <div class="top">
    <form action="" method="post">
    
        <input type="text" name="search"  id="search" placeholder="Search by Username, Mobile, or Role">
        <input type="submit" value="Search" class="btn">
    </form>
    
    </div>
    <h1 style="text-align:center">List of Users</h1>
     <div class="whole">
    <?php
    if (isset($_POST['search']) && empty($_POST['search'])) {
        // If the search box is empty, fetch all users
        $result = mysqli_query($con, "SELECT UserID, Username, Mobile, Role, Photo FROM users");
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="user-item">';
            echo '<div class="user-img">';
            echo '<img src="../uploads/' . $row["Photo"] . '" alt="Profile Photo" style="width:250px;height:200px;object-fit:contain">';
            echo '</div>';
            echo '<div class="user-details">';
            echo "<p>Username: " . $row["Username"] . "</p>";
            echo "<p>Mobile: " . $row["Mobile"] . "</p>";
            echo "<p>Role: " . $row["Role"] . "</p>";
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No users found.</p>";
    }
    ?>
    </div>

</body>
</html>
