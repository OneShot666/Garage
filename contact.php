<?php
    include("php/fonction.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Contact";
    $nav = "contact";
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
            Envoyez-nous vos avis !
        </h1>

        <p>
            Dîtes-nous ce que vous pensez de notre site, nos modèles, etc.
        </p>

        <br>
        <br>
        <br>

        <div>
            <nav content="Message" class="formulaire">
                <form action="include/connected.php" method="post">
                    <label for="speudo">Pseudonyme :
                        <input type="text" name="speudo" placeholder="ex: Tintin" required>
                    </label>
                    <br><br>
                    <label for="mail">Adresse mail :
                        <input type="text" name="mail" placeholder="adresse@mail.com">
                    </label>
                    <br><br>
                    <label for="password">Message :
                        <input type="text" name="message" placeholder="" required>
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
