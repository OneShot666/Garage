<?php
    include("php/fonction.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Connexion";
    $nav = "inscription";
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body style="text-align: center">
        <?php require_once "include/header.php" ?>

        <br>

        <h1>
            Vous êtes connecté !
        </h1>

        <p>
            Vous pouvez désormais retourner au site grâce au bouton ci-dessous.
        </p>

        <br>

        <button style="text-align: center;">
            <a href="../accueil.php">Accueil</a>
        </button>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
