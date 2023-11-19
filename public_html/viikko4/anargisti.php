<!DOCTYPE html>

<?php
    $y_tiedot = "dbname=nxanph user=nxanph password=ezd6XpnRIzkK9nq";

    if (!$yhteys = pg_connect($y_tiedot)) {
        die("Tietokantayhteyden luominen epäonnistui.");
    }

    // POST käsittelijä
    if (!empty($_POST("nimi"))) {
        $nimi = pg_escape_string($_POST("nimi"));
        header("Location: tervetuloaanargisti.php");
    }

    pg_close($yhteys);
?>

<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Anargisti</title>
</head>
<body>
    <h1>Anargisti</h1>
    <p>Liity jäseneksi anargistien ammattiyhdistykseen!</p>
    <form action="anargisti.php" method="post">
        <label for="nimi">Nimi:</label>
        <input type="text" name="nimi" id="nimi" />
        <input type="submit" value="Jatka">
    </form>
</body>
</html>