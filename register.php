<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
    if(isset($_POST["submitButton"])){
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);

        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);

        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
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
                <h3>Sign Up!</h3>
                <span>to watch movies</span>
            </div>
            <form method="POST">
                <input type="text" name="firstName" placeholder="First Name" required>
                <input type="text" name="lastName" placeholder="Last Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="email" name="email2" placeholder="Confirm Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password2" placeholder="Confirm Password" required>
                <input type="submit" name="submitButton" value="Submit"> 
            </form>
            <p class="signInMessage">Already have an Account? <a href="login.php"><span> Click Here</span></a> to Sign in!</p>
        </div>

    </div>

</body>
</html>
