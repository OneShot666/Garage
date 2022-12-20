<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION, $patterns;
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
            <link rel="icon" type="image/png" href="images/car/icon.svg"><!--https://ionic.io/ionicons"-->
            <!--ion-icon name="car-sport-outline"></ion-icon-->
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

        <?php
            if (isset($_POST['message']) and isset($_POST['envoyer'])) {
                $subject = ($is_connected) ? "Avis de ".$_SESSION['username'] : "Avis d'un utilisateur";
                $message = nl2br($_POST['message']);
                $reply = "From: mir.nathan42@gmail.com"."\r\n"."Reply-to: ".$_POST['mail'];
                $back = mail('p0ub3ll3m4n@gmail.com', $subject, $message, $reply);  // ! Vérifier comment ça marche
                if ($back) { echo "<h3>Votre avis a bien été envoyé.</h3>"; }
            }
        ?>

        <div class="formulaire" style="text-align: left; width: 305px;">
            <nav content="Message">
                <form action="" method="post">
                    <label>
                        Pseudonyme :
                        <?php $pseudo = ($is_connected) ? "value='".$_SESSION['username']."' readonly" :
                            "placeholder='Votre pseudonyme'"; ?>
                        <input type="varchar" name="speudo" <?= $pseudo; ?>
                            pattern="<?= $patterns['username']; ?>" required>
                        <br><br>
                        Adresse mail :
                        <?php $mail = ($is_connected and isset($_SESSION['mail']) and !empty($_SESSION['mail'])) ?
                            "value='".$_SESSION['mail']."' readonly" : "placeholder='adresse@mail.com'"; ?>
                        <input type="mail" name="mail" <?= $mail; ?>
                            pattern="<?= $patterns['password']; ?>" required>
                        <br><br>
                        Message : <br>
                        <textarea name="message" placeholder="Au moins 20 caractères"
                            pattern="<?= $patterns['message']; ?>" required></textarea>
                        <br><br>
                    </label>

                    <input type="submit" name="envoyer" value="Envoyer">
                </form>
            </nav>
        </div>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
