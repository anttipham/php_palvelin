<!DOCTYPE html>

<?php
    $y_tiedot = "dbname=nxanph user=nxanph password=ezd6XpnRIzkK9nq";

    if (!$yhteys = pg_connect($y_tiedot)) {
        die("Tietokantayhteyden luominen epäonnistui.");
    }

    // POST käsittelijä
    if (!empty($_POST["nimi"])) {
        $nimi = pg_escape_string($_POST["nimi"]);
        // Hae tietokannasta suurin nro
        $suurin_nro_kysely = "SELECT COALESCE(MAX(nro), 1) + 1 uusi_nro
                              FROM jasenyys";
        $suurin_nro_vastaus = pg_query($suurin_nro_kysely);
        $suurin_nro = pg_fetch_row($suurin_nro_vastaus)[0];

        // Lisää tietokantaan
        $lisays_kysely = "INSERT INTO jasenyys (nro, nimi)
                          VALUES ('$suurin_nro', '$nimi')";
        $lisays = pg_query($lisays_kysely);

        if (!$lisays && (pg_affected_rows($lisays) == 0)) {
            die("Jäsenyyden lisäys epäonnistui.");
        }

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