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
   
 
<h1>Registrer deg</h1>
<form action="authenticate.php" method="post">
<input type="text" name="username" placeholder="Brukernavn" required>
<input type="password" name="password" placeholder="Passord" required>
<button type="submit">Registrer</button>
</form>
 
   
<?php
// authenticate.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
 
    // Valider brukerdata og lagre i database (ikke implementert her)
    // ...
 
    echo "<p>Registrering vellykket! Logg inn <a href='user_profile.php'>her</a>.</p>";
}
?>
 

 
    <h1>Min Profil</h1>
<p>Velkommen, <?php echo $_SESSION["username"]; ?>!</p>
<a href="logout.php">Logg ut</a>
 
 
 
 
 
 
 
</body>
</html>