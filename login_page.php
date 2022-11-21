<?php
    include("php/function.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Inscription";
    $nav = "inscription";
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
          <link rel="icon" type="image/png" href="https://ionic.io/ionicons">
          <ion-icon name="car-sport-outline"></ion-icon>
          <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
        <?php require_once "include/header.php" ?>

        <br>

        <h1>
            <?php require_once "php/check_login.php" ?>
        </h1>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
