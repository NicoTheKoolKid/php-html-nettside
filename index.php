
<?php
session_start();
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$email = $password = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
 
    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }
     
    $recaptchaResponse = $_POST['g-recaptcha-response'];
 
    // Your secret key (replace with your actual secret key)
    $secretKey = "6LeuGa8pAAAAAJKCIARclWcVBrQ2m9BmX_9ljcuo";

    // Verify the reCAPTCHA response
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $recaptchaResponse);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {
 
        // Validate credentials
        if (empty($username_err) && empty($password_err)) {
            // Prepare a select statement
            $sql = "SELECT id, username, password FROM innlogging WHERE username = ?";
 
            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
 
                // Set parameters
                $param_username = $username;
 
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Store result
                    mysqli_stmt_store_result($stmt);
 
                    // Check if username exists, if yes then verify password
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($password, $hashed_password)) {
                                // Password is correct, so start a new session
                                session_start();
 
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                
                                // Redirect user to welcome page
                                header("location: index2.php");
                            } else {
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else {
                        // Display an error message if username doesn't exist
                        $username_err = "No account found with that username.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($conn);
    }
}
    
    
    // Close connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rise Bycicles</title>
       
    <?php
    echo "<link rel='stylesheet' type='text/css' href='stylesheet.css'>";
    ?>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>


<div class="velkommen">
    <h1>Velkommen til Rise Bycicles!</h1>
</div>
<hr class="velk-hr">


<div class="login">
<h1>Logg inn</h1>

<form method="post">
<input type="text" name="username" placeholder="Brukernavn" required>
<input type="password" name="password" placeholder="Passord" required>
<input class="emailbox" type="email" name="email" placeholder="Email" required>
<div class="g-recaptcha" data-sitekey="6LeuGa8pAAAAAJSD2mZJb0o-ziEMwitC53Qqesu8"></div>
<button type="submit" class="btn">Logg inn</button>
</form>
<a href="registrering.php">
    <button type="submit" class="reg-btn">Registrer deg her!</button>
</a>

<form action="?" method="POST">
    <br/>
    <input type="submit" value="Submit">
</form>
</div>


<img src="Bilder/RiseLogo.png" alt="Rise Bicycles Logo" class="logobilde" width="140px" class="logobilde">
 
</body>
</html>