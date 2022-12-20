<<<<<<< HEAD
<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Se connecter";
    $nav = "connect";   // login
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
            Retrouvez votre compte, vos produits favoris <br>et votre panier !
        </h1>

        <h3>
            Une fois connecté(e), vous pourrez personnaliser <br>vos favoris et
            votre panier comme bon vous semble.
        </h3>
        <br><br>

        <div class="login">
            <nav content="Inscription" class="formulaire" align="center">
                <form action="connect_page.php" method="post">
                    <label for="speudo">Pseudonyme :
                        <input type="varchar" name="username" placeholder="Pseudonyme" required>
                    </label>
                    <br><br>
                    <label for="password">Mot de passe :
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </label>
                    <br><br>
                    <input type="submit" name="envoyer" value="Envoyer">
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
    global $nom_du_site, $is_connected, $is_admin, $_SESSION, $patterns;
    $page_name = $nom_du_site . " - Se connecter";
    $nav = "connect";   // login
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
            Retrouvez votre compte, vos produits favoris <br>et votre panier !
        </h1>

        <h3>
            Une fois connecté(e), vous pourrez personnaliser <br>vos favoris et
            votre panier comme bon vous semble.
        </h3>
        <br><br>

        <div class="login">
            <nav content="Inscription" class="formulaire" align="center">
                <form action="connect_page.php" method="post">
                    <label for="speudo">Pseudonyme :
                        <input type="varchar" name="username" placeholder="Pseudonyme" required>
                    </label>
                    <br><br>
                    <label for="password">Mot de passe :
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </label>
                    <br><br>
                    <input type="submit" name="envoyer" value="Envoyer">
                </form>
            </nav>
        </div>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
