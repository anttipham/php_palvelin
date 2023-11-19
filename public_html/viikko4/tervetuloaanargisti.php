<!DOCTYPE html>

<?php
    session_start();

    $nimi = $_SESSION["nimi"];
    $nro = $_SESSION["nro"];

    session_destroy();
?>

<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Hei, anargisti!</title>
</head>
<body>
    <?php
        echo "Tervetuloa jäseneksi $nimi. Jäsennumerosi on $nro."
    ?>
</body>
</html>