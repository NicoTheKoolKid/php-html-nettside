<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    echo "<link rel='stylesheet' type='text/css' href='stylesheet.css'>";
    ?>
</head>
<body>

<h1 class="velkommen"> Registrering vellykket </h1>


<?php
// authenticate.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
 
    // Valider brukerdata og lagre i database (ikke implementert her)

}
?>

<div class="regsidelink">
<p>Logg inn <a href='user_profile.php'>her</a>.</p>
</div>

</body>
</html>