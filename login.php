<?php
    if(isset($_POST["submitButton"])){
        echo "Form was submitted";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To WatchFob</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
</head>
<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <div>
                    <img src="assets/images/logo.png" alt="Logo">

                </div>
                <h3>Log In!</h3>
                <span>to continue watching movies</span>
            </div>
            <form method="POST">
               
                <input type="text" name="username" placeholder="Username" required>
                
                <input type="password" name="password" placeholder="Password" required>
                
                <input type="submit" name="submitButton" value="Submit"> 
            </form>
            <p class="signInMessage">Don't have an account? <a href="register.php"><span> Click Here</span></a> to make one!</p>
        </div>

    </div>

</body>
</html>
