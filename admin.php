<?php
    include("php/function.php");
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    if (!$_SESSION['username']) { header("Location: index.php"); }
    $page_name = $nom_du_site . " - Administrateur";
    $nav = "admin";
?>

<!-- Ajouter une vérification/redirection pour voir si un compte est connecté -->

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
            <link rel="icon" type="image/png" href="images/icon.svg"><!--https://ionic.io/ionicons"-->
            <!--ion-icon name="car-sport-outline"></ion-icon-->
            <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
        <?php require_once "include/header.php" ?>
        <br>

        <?php require "php/car_add.php" ?>

        <?php require "php/car_mod.php" ?>

        <?php require "php/car_del.php" ?>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
