<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
    <h2>Tietokannassa olevat opiskelijat</h2>

<?php

// Tulostaa ennaltamaaratyn kyselyn WWW-sivulle
//echo "Tietokannassa olevat opiskelijat. <br /><br />";

$y_tiedot = "dbname=tiko user=tiko password=salasana";

if (!$yhteys = pg_connect($y_tiedot))
   die("Tietokantayhteyden luominen epäonnistui.");


$tulos = pg_query("SELECT nimi, o_nro FROM opiskelijat");
if (!$tulos) {
  echo "Virhe kyselyssä.\n";
  exit;
}

while ($rivi = pg_fetch_row($tulos)) {
  echo "Opiskelijan $rivi[0]  numero on $rivi[1]";
  echo "<br />\n";
}

pg_close($yhteys);

?>

</body>
</html>