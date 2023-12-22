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
<h3 id="head" class="admin_log">If You are the Admin <a href="./admin.php" > Click Here </a></h3>
    <div class="container">
   
        <div class="heading" >
            <h1>Online Voting System</h1>
        </div>
        <div class="login">
          <div class="signin"> <h2>Sign In</h2></div>
            <form action="./actions/login.php" method="post">
                <div class="input-container">
                    <label for="mn"> Mobile no</label>
                    <input type="text" placeholder="Mobile number" maxlength="10" minlength="10" name="mobile"  id="mn"required autofocus>
                </div>
                <div class="input-container">
                    <div class="password-container">
                        <label for="ps">Password</label>
                        <input type="password" id="password" placeholder="Password" name="password" id="ps" required>
                    </div>
                </div>
                <input type="submit" value="Login" class="loginbutton">
                <div class="account">
                <p id="link"> Need an account? <a href="./pages/registration.php">Sign Up </a></p>
                </div>
            </form>
        </div>
    </div>
 
  
</body>
</html>
