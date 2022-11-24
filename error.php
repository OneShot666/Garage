<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Error";
    $nav = "error";
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
            <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body style="position:middle;">
        <?php require_once "include/header.php" ?>
        <br>

        <h1>
            Erreur !
        </h1>

        <p>
            Il semblerait qu'une erreur soit survenue !
        </p>
        <br>

        <p>
          <ol>Veuillez vérifier que :
            <li>L'url saisie est correcte.</li>
            <li>Vous êtes autorisé(e) à accèder à cette page.</li>
          </ol>
        </p>
        <br>

        <button><a href='index.php'>Retour à l'accueil</a></button>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
