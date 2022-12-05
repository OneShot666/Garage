<<<<<<< HEAD
<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Se déconnecter";
    $nav = "login";
    if (isset($_GET["logout"]) AND $_GET["logout"] == "Se déconnecter") {
        $_SESSION = array();                                                    // Never use session_destroy(); !
        $is_connected = False;
        $is_admin = False;
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
            <link rel="icon" type="image/png" href="images/car/icon.svg"><!--https://ionic.io/ionicons"-->
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
        <br>

        <p>
            Si vous vous déconnecter, vous ne pourrez plus accèder à vos favoris, votre liste de choix et vos cookies.
            <br>
            Revenez vite !
        </p>
        <br><br>

        <div>
            <nav content="Deconnexion">
                <form action="" method="get">
                    <input style="font-size: 20px; padding: 8px;" type="submit" name="logout" value="Se déconnecter">
                </form>
            </nav>
        </div>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
=======
<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Se déconnecter";
    $nav = "login";
    if (isset($_GET["logout"]) AND $_GET["logout"] == "Se déconnecter") {
        $_SESSION = array();                                                    // Never use session_destroy(); !
        $is_connected = False;
        $is_admin = False;
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
            <link rel="icon" type="image/png" href="images/car/icon.svg"><!--https://ionic.io/ionicons"-->
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
        <br>

        <p>
            Si vous vous déconnecter, vous ne pourrez plus accèder à vos favoris, votre liste de choix et vos cookies.
            <br>
            Revenez vite !
        </p>
        <br><br>

        <div>
            <nav content="Deconnexion">
                <form action="" method="get">
                    <input style="font-size: 20px; padding: 8px;" type="submit" name="logout" value="Se déconnecter">
                </form>
            </nav>
        </div>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
