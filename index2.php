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
 

 
<h1>Min Profil</h1>
<p>Velkommen, <?php echo $_SESSION["username"]; ?>!</p>
<a href="index.php"><button type="submit">Logg ut</button></a>
 
 
 
 
 
 
 
</body>
</html>