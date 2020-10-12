<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])){
        

        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        
 
        $success = $account->login($username, $password);

        if($success){ 
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }
    function getInputValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
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
                
                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username");?>" required>
                
                <input type="password" name="password" placeholder="Password" required>
                
                <input type="submit" name="submitButton" value="Submit"> 
            </form>
            <p class="signInMessage">Don't have an account? <a href="register.php"><span> Click Here</span></a> to make one!</p>
        </div>

    </div>

</body>
</html>
