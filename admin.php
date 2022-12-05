<<<<<<< HEAD
<?php
    include("php/function.php");
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    Redirection("a");
    $page_name = $nom_du_site . " - Administrateur";
    $nav = "admin";
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
            <link rel="icon" type="image/png" href="images/car/icon.svg"><!--https://ionic.io/ionicons"-->
            <!--ion-icon name="car-sport-outline"></ion-icon-->
            <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
        <?php require_once "include/header.php" ?>
        <br>

        <h1 id="car">Voitures</h1>
        <br>

        <?php require "php/car_add.php" ?>

        <?php require "php/car_mod.php" ?>

        <?php require "php/car_del.php" ?>
        <br>

        <h1 id="brand">Marques</h1>
        <br>

        <?php require "php/brand_add.php" ?>

        <?php require "php/brand_mod.php" ?>

        <?php require "php/brand_del.php" ?>
        <br>

        <h1 id="user">Utilisateurs</h1>
        <br>

        <?php require "php/user_add.php" ?>

        <?php require "php/user_mod.php" ?>

        <?php require "php/user_del.php" ?>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
=======
<?php
    include("php/function.php");
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    Redirection("a");
    $page_name = $nom_du_site . " - Administrateur";
    $nav = "admin";
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
            <link rel="icon" type="image/png" href="images/car/icon.svg"><!--https://ionic.io/ionicons"-->
            <!--ion-icon name="car-sport-outline"></ion-icon-->
            <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
        <?php require_once "include/header.php" ?>
        <br>

        <h1>Voitures</h1>
        <br>

        <?php require "php/car_add.php" ?>

        <?php require "php/car_mod.php" ?>

        <?php require "php/car_del.php" ?>
        <br>

        <h1>Marques</h1>
        <br>

        <?php require "php/brand_add.php" ?>

        <?php require "php/brand_mod.php" ?>

        <?php require "php/brand_del.php" ?>
        <br>

        <h1>Utilisateurs</h1>
        <br>

        <?php require "php/user_add.php" ?>

        <?php require "php/user_mod.php" ?>

        <?php require "php/user_del.php" ?>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
