<?php
    include("php/fonction.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - S'inscrire";
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
            Rejoignez les gararistes de l'express !
        </h1>

        <p>
            En vous inscrivant, vous pourrez désormais louer et acheter vos modèles de voiture favoris.
            <br>
            Dépêchez-vous !
        </p>

        <br>
        <br>
        <br>

        <div>
            <nav content="Inscription" class="formulaire">
                <form action="include/connected.php" method="post">
                    <label for="name">Nom :
                        <input type="text" name="name" placeholder="John" required>
                    </label>
                    <br><br>
                    <label for="nickname">Prénom :
                        <input type="text" name="nickname" placeholder="Smith" required>
                    </label>
                    <br><br>
                    <label for="age">Age :
                        <input type="text" name="age" placeholder="18 ans et plus" required>
                    </label>
                    <br><br>
                    <label for="phone">Téléphone :
                        <input type="text" name="phone" placeholder="+687 12.34.56">
                    </label>
                    <br><br>
                    <label for="mail">Adresse mail :
                        <input type="text" name="mail" placeholder="adresse@mail.com">
                    </label>
                    <br><br>
                    <label for="speudo">Pseudonyme :
                        <input type="text" name="speudo" placeholder="ex: Tintin" required>
                    </label>
                    <br><br>
                    <label for="password">Mot de passe :
                        <input type="password" name="password"
                               placeholder="Au moins 8 caractères, avec des chiffres et des lettres" required>
                    </label>
                    <br><br>
                    <input type="submit" value="Envoyer">
                </form>
            </nav>
        </div>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>