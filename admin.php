<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="title-icon.png">
    
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo+Play&display=swap" rel="stylesheet">

    <title>Login</title>
</head>
<body>
    <div class="container">
   
        <div class="heading" >
            <h1>Online Voting System</h1>
        </div>
        <div class="login">
          <div class="signin"> <h2>Sign In</h2></div>
          <form action="./actions/admin.php" method="post">
                <div class="input-container">
                    <label for="an">Admin Name</label>
                    <input type="text" placeholder="Admin name " name="admin_name" id="an" required>
                </div>
                <div class="input-container">
                <label for="ps">Password</label>
                    <input type="password" placeholder="Password" name="password" id="ps" required>
                </div>
                <button type="submit" class="loginbutton">Login</button>
                <br>
                <p> Back to Login <a href="./index.php"> Click Here </a> </p>
            </form>
        </div>
    </div>
 
  
</body>
</html>


