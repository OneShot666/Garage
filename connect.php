<?php
    include("php/fonction.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Se connecter";
    $nav = "connect";
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
            Retrouvez votre compte et tout vos achats !
        </h1>

        <br>

        <p>
            N'oubliez pas l'abonnement premium.
        </p>

        <br>

        <div class="login">
            <nav content="Inscription" class="formulaire">
                <form action="php/check_connect.php" method="post">
                    <label for="speudo">Pseudonyme :
                        <input type="text" name="speudo" placeholder="ex: Tintin" required>
                    </label>
                    <br><br>
                    <label for="password">Mot de passe :
                        <input type="text" name="password"
                               placeholder="Au moins 8 caractères, avec des chiffres et des lettres" required>
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
