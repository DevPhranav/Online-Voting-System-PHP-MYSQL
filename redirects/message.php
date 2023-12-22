<!DOCTYPE html>
<html>
<head>
    <title>Registration Completed</title>
    <link rel="stylesheet" href="../css/message.css">
    <link rel="icon" type="image/x-icon" href="../title-icon.png">
</head>
<body>
    <div id="loading"><img src="../icons/icons8-loading-circle.gif" alt="⏳"></div>
    <div id="message">
        <h1>Registration Successfully Completed <span class="emoji"> </h1><img class="img" src="../icons/check.png" alt="🎉"></span>
        <form action="../" method="post">
        <p><button type="submit" class="ebutton">Click here to login <span class="emoji"></span></button></p>
        </form>
        
    </div>

    <script>
        // Simulate loading delay
        setTimeout(function() {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('message').style.display = 'block';
        }, 2000); // Adjust the delay time (in milliseconds) as needed
    </script>
</body>
</html>
