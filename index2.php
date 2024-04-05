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
 
<?php
session_start(); // Start sesjonen (hvis ikke allerede startet)

// Sjekk om brukeren er logget inn
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Hent brukernavnet fra sesjonen
    echo "Velkommen, $username!"; // Vis velkomstmelding med brukernavnet
} else {
    echo "Velkommen, gjest!"; // Hvis ikke logget inn, vis standard velkomstmelding
}
?>
 
 
 
 
 
</body>
</html>