<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Se déconnecter";
    $nav = "login";
    if (isset($_GET["logout"]) AND $_GET["logout"] == "Se déconnecter") {
        $_SESSION = array();
        $is_connected = False;
        // /* session_destroy(); */                                             // !!! Empêche la réutilisation du code ?!
        header("Location: index.php");
    }
?>

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
            <nav content="Deconnexion">
                <form action="" method="get">
                    <input type="submit" name="logout" value="Se déconnecter">
                </form>
            </nav>
        </div>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
