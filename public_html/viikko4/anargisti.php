<!DOCTYPE html>

<?php
    session_start();

    $y_tiedot = "dbname=nxanph user=nxanph password=ezd6XpnRIzkK9nq";

    if (!$yhteys = pg_connect($y_tiedot)) {
        die("Tietokantayhteyden luominen epäonnistui.");
    }

    // POST käsittelijä
    if (!empty($_POST["nimi"])) {
        $nimi = pg_escape_string($_POST["nimi"]);
        // Aloita transaktio
        pg_query("BEGIN") or die("Transaktion aloitus epäonnistui.");
        // Hae tietokannasta suurin nro
        $suurin_nro_vastaus = pg_query(
            "SELECT COALESCE(MAX(nro), 0) + 1 uusi_nro FROM jasenyys"
        ) or die("Suurimman jäsennumeron haku epäonnistui.");
        $suurin_nro = pg_fetch_row($suurin_nro_vastaus)[0];
        // Lisää tietokantaan
        $lisays = pg_query(
            "INSERT INTO jasenyys (nro, nimi) VALUES ('$suurin_nro', '$nimi')"
        ) or die("Jäsenyyden lisäys epäonnistui.");
        // Vahvista transaktio
        pg_query("COMMIT") or die("Transaktion vahvistus epäonnistui.");
        // Tallenna sessiomuuttujat
        $_SESSION["nimi"] = $nimi;
        $_SESSION["nro"] = $suurin_nro;

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