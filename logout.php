<?php
    include("php/fonction.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Se déconnecter";
    $nav = "login";
?>

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

        <br>

        <h1>
            Se déconnecter
        </h1>

        <p>
            Si vous vous déconnecter, vous ne pourrez plus accèder à vos favoris, votre liste de choix et vos cookies.
            <br>
            Revenez vite !
        </p>

        <br>
        <br>
        <br>

        <div>
            <nav content="Deconnexion" class="formulaire">
                <form action="accueil.php" method="post">
                    <input type="submit" value="Se déconnecter">
                </form>
            </nav>
        </div>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
