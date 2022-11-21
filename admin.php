  <?php
    include("php/function.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Administrateur";
    $nav = "admin";
?>

<!-- Ajouter une vérification pour voir si un compte est connecté -->

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
        <?php require_once "include/header.php" ?>

        <br><br><br>

        <div class="formulaire" style="float: left; margin: 0 3%; width: 35%;">
            <h1>
                <span>Ajouter une voiture</span>
            </h1>

            <br>

            <?php require "include/car_part.php" ?>
        </div>

        <br>

        <div class="formulaire" style="float: left; margin: 0 3%; width: 35%;">
            <h1>
                Modifier une voiture
            </h1>

            <br>

            <?php require "include/car_part.php" ?>
        </div>

        <br>

        <div class="formulaire" style="float: left; margin: 0 3%; width: 35%;">
            <h1>
                Supprimer une voiture
            </h1>

            <br>

            <?php require "include/car_part.php" ?>
        </div>

        <br>

        <div></div>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
