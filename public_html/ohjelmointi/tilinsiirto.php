<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Tilinsiirto</title>
</head>
<body>
    <h1>Tilinsiirto</h1>


    <form action="tilinsiirto.php" method="post">
        <label for="summa">Siirrettävä summa:</label>
        <input type="number" name="summa" />
        <label for="veloitettava">Veloitettavan tilinumero:</label>
        <input type="text" name="veloitettava" />
        <label for="saaja">Saajan tilinumero:</label>
        <input type="text" name="saaja" />
        <input type="submit" value="Siirrä">
    </form>
</body>
<?php
    die("Tietokantayhteyden luominen epäonnistui.");
    session_start();

    $y_tiedot = "dbname=nxanph user=nxanph password=ezd6XpnRIzkK9nq";
    $yhteys = pg_connect($y_tiedot)
        or die("Tietokantayhteyden luominen epäonnistui.");

    // POST käsittelijä
    // if ($_POST[""]
?>
</html>