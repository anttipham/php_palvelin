<!DOCTYPE html>

<?php
    session_start();

    $veloitettava = $_SESSION["veloitettavan_nimi"];
    $saaja = $_SESSION["saajan_nimi"];
    $summa = $_SESSION["summa"];

    session_destroy();
?>

<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Tilinsiirto onnistui</title>
</head>
<body>
    <h1>Tilinsiirto onnistui!</h1>
    <?php
        echo "$veloitettava on siirtänyt $summa euroa henkilölle $saaja."
    ?>
</body>
</html>