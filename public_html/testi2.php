<?php

// luodaan tietokantayhteys ja ilmoitetaan mahdollisesta virheestä

$y_tiedot = "dbname=nxanph user=nxanph password=ezd6XpnRIzkK9nq";

if (!$yhteys = pg_connect($y_tiedot))
   die("Tietokantayhteyden luominen epäonnistui.");

// isset funktiolla jäädään odottamaan syötettä.
// POST on tapa tuoda tietoa lomaketta (tavallaan kutsutaan lomaketta).
// Argumentti tallenna saadaan lomakkeen napin nimestä.

if (isset($_POST['tallenna']))
{
    // suojataan merkkijonot ennen kyselyn suorittamista
    // suojataan merkkijonot ennen kyselyn suorittamista

    $opnro  = intval($_POST['opnro']);
    $nimi   = pg_escape_string($_POST['nimi']);
    $aine   = pg_escape_string($_POST['aine']);

    // jos kenttiin on syötetty jotain, lisätään tiedot kantaan

    $tiedot_ok = $opnro != 0 && trim($nimi) != '' && trim($aine) != '';

    if ($tiedot_ok)
    {
        $kysely = "INSERT INTO opiskelijat (o_nro, nimi, paa_aine)
		 VALUES ($opnro, '$nimi', '$aine')";
        $paivitys = pg_query($kysely);

        // asetetaan viesti-muuttuja lisäämisen onnistumisen mukaan
	// lisätään virheilmoitukseen myös virheen syy (pg_last_error)

        if ($paivitys && (pg_affected_rows($paivitys) > 0))
            $viesti = 'Opiskelija lisätty!';
        else
            $viesti = 'Opiskelijaa ei lisätty: ' . pg_last_error($yhteys);
    }
    else
        $viesti = 'Annetut tiedot puutteelliset - tarkista, ole hyvä!';

}

// suljetaan tietokantayhteys

pg_close($yhteys);

?>

<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>

    <!-- Lomake lähetetään samalle sivulle (vrt lomakkeen kutsuminen) -->
    <form action="testi2.php" method="post">

    <h2>Opiskelijan lisäys</h2>

    <?php if (isset($viesti)) echo '<p style="color:red">'.$viesti.'</p>'; ?>

	<!—PHP-ohjelmassa viitataan kenttien nimiin (name) -->
	<table border="0" cellspacing="0" cellpadding="3">
	    <tr>
    	    <td>Opiskelijanumero</td>
    	    <td><input type="text" name="opnro" value="" /></td>
	    </tr>
	    <tr>
    	    <td>Nimi</td>
    	    <td><input type="text" name="nimi" value="" /></td>
	    </tr>
	    <tr>
    	    <td>Pääaine</td>
    	    <td><input type="text" name="aine" value="" /></td>
	    </tr>
	</table>

	<br />

	<!-- hidden-kenttää käytetään varotoimena, esim. IE ei välttämättä
	 lähetä submit-tyyppisen kentän arvoja jos lomake lähetetään
	 enterin painalluksella. Tätä arvoa tarkkailemalla voidaan
	 skriptissä helposti päätellä, saavutaanko lomakkeelta. -->

	<input type="hidden" name="tallenna" value="jep" />
	<input type="submit" value="Lisää opiskelija" />
	</form>

</body>
</html>