<?php
session_start();
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $email = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    // Validate username
    if (empty(trim($_POST["username"])) || empty(trim($_POST["password"])) || empty(trim($_POST["email"]))) {
        echo "Please enter a username, password and an email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM innlogging WHERE username = ?";
 
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
 
            // Set parameters
            $param_username = trim($_POST["username"]);
 
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);
 
                if (mysqli_stmt_num_rows($stmt) == 0) {
                    $username = trim($_POST["username"]);
                    $email = trim($_POST["email"]);
                    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
 
                    // Prepare an insert statement
                    $sql = "INSERT INTO innlogging (username, password, email) VALUES (?, ?, ?)";
 
                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_email);
 
                        // Set parameters
                        $param_username = $username;
                        $param_password = $password;
                        $param_email = $email;
 
                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            // Redirect to login page
                            header("location: index.php");
                            exit();
                        } else {
                            echo "Something went wrong. Please try again later.";
                        }
                    }
                } else {
                    echo "This username is already taken.";
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
</head>
<body>



<div class="registrering">
<h1>Registrer deg</h1>

<form method="post">
<input type="text" name="username" placeholder="Brukernavn" required>
<input type="password" name="password" placeholder="Passord" required>
<input class="emailbox" type="email" name="email" placeholder="email" required>
    <button type="submit" class="btn">Registrer deg</button>
</form>
</div>

 
 
 
 
 
 
</body>
</html>