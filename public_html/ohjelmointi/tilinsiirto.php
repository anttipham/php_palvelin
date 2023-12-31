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
        <div><input type="submit" name="siirra" value="Siirrä"></div>
    </form>
</body>
<?php
    session_start();

    $y_tiedot = "dbname=nxanph user=nxanph password=ezd6XpnRIzkK9nq";
    $yhteys = pg_connect($y_tiedot)
        or die("Tietokantayhteyden luominen epäonnistui.");

    // POST käsittelijä
    if (!isset($_POST["siirra"])) {
        die();
    }
    $summa = intval($_POST["summa"]);
    $veloitettava_nro = trim(pg_escape_string($_POST["veloitettava"]));
    $saaja_nro = trim(pg_escape_string($_POST["saaja"]));
    if (empty($summa) || empty($veloitettava_nro) || empty($saaja_nro)) {
        die("Täytä kaikki kentät.");
    }

    // SQL-transaktio
    pg_query("BEGIN") or die("Virhe: " . pg_last_error());

    // Tarkista että tilit ovat olemassa
    $veloitettava = pg_query(
        "SELECT summa, omistaja FROM Tilit WHERE tilinumero = '$veloitettava_nro'"
    ) or die("Virhe: " . pg_last_error());
    $saaja = pg_query(
        "SELECT summa, omistaja FROM Tilit WHERE tilinumero = '$saaja_nro'"
    ) or die("Virhe: " . pg_last_error());
    if (pg_num_rows($veloitettava) == 0) {
        die("Veloitettava tili ei ole olemassa.");
    }
    if (pg_num_rows($saaja) == 0) {
        die("Saajan tili ei ole olemassa.");
    }

    // Vähennä summa veloitettavalta tililtä
    $muutos = pg_query(
        "UPDATE Tilit SET summa = summa - $summa
        WHERE tilinumero = '$veloitettava_nro' AND summa >= $summa;"
    ) or die("Virhe: " . pg_last_error());
    if (pg_affected_rows($muutos) == 0) {
        pg_query("ROLLBACK") or die("Virhe: " . pg_last_error());
        die("Veloitettavalla tilillä ei ole tarpeeksi rahaa.");
    }
    // Lisää summa saajan tilille
    $muutos = pg_query(
        "UPDATE Tilit SET summa = summa + $summa WHERE tilinumero = '$saaja_nro';"
    ) or die("Virhe: " . pg_last_error());
    if (pg_affected_rows($muutos) == 0) {
        pg_query("ROLLBACK") or die("Virhe: " . pg_last_error());
        die("Virhe saajan päivityksessä.");
    }
    // Kommitoi transaktio
    pg_query("COMMIT") or die("Virhe: " . pg_last_error());

    // Tallenna sessiomuuttujiin
    $_SESSION["veloitettavan_nimi"] = pg_fetch_row($veloitettava)[1];
    $_SESSION["saajan_nimi"] = pg_fetch_row($saaja)[1];
    $_SESSION["summa"] = $summa;

    // Siirry onnistumissivulle
    header("Location: tilinsiirto_onnistui.php");
?>
</html>