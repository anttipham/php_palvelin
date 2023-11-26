<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Tilinsiirto</title>
</head>
<body>
    <h1>Tilinsiirto</h1>

    <form action="tilinsiirto.php" method="post">
        <div><label for="summa">Siirrettävä summa:</label></div>
        <div><input type="number" name="summa" /></div>
        <div><label for="veloitettava">Veloitettavan tilinumero:</label></div>
        <div><input type="text" name="veloitettava" /></div>
        <div><label for="saaja">Saajan tilinumero:</label></div>
        <div><input type="text" name="saaja" /></div>
        <div><input type="submit" value="Siirrä"></div>
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