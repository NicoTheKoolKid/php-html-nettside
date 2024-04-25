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



<div>
    <a href="index.php"><button type="submit" class="logout">Logg ut</button></a>
</div> 

<h1 id="idx2os">Rise Bicycles</h1>

<?php
session_start(); // Start sesjonen (hvis ikke allerede startet)

// Sjekk om brukeren er logget inn
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Hent brukernavnet fra sesjonen
    echo "<h2> Velkommen, $username!</h2>"; // Vis velkomstmelding som en overskrift
} 
?>

<hr>


<?php

// Koble til databasen
$db = new PDO('mysql:host=localhost;dbname=rise bicycles;charset=utf8', 'root', '');
// Hent syklene'

$resultat = $db->query('SELECT * FROM sykkelinfo');

echo '<div class="container">';
// Loop gjennom hver sykkelinfo og vis den
foreach ($resultat as $sykkelinfo) {
    echo '<div class="box">';
    echo '<div class="info"><h2 id="boxtextH2">' . $sykkelinfo['Merke'] . ' - ' . $sykkelinfo['Type'] . '</h2>';

    echo '<div class="boksinfotekst">' . 'Bruker: ' . $sykkelinfo['Bruker'] . '<br>';
    echo 'Farge: ' . $sykkelinfo['Farge'] . '<br>';
    echo 'Produksjonsår: ' . $sykkelinfo['Produksjonsår'] . '<br>';
    echo 'Bremsetype: ' . $sykkelinfo['Bremsetype'] . '</div>';
    echo '<div class="price">Pris: ' . $sykkelinfo['Pris'] . '</div>';
    echo '<div class="boxbilde">' . '<img src="' . $sykkelinfo['Bilde'] . '" alt="' . $sykkelinfo['Merke'] . ' sykkelinfo">' . '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';

?>


<img src="Bilder/RiseLogo.png" alt="Rise Bicycles Logo" class="logobilde" width="140px" id="logobilde2"> 
 
</body>
</html>