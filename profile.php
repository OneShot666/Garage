<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Profil";
    $nav = "profile";
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
            <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
        <?php require_once "include/header.php" ?>

        <br>

        <div class="formulaire" style="color: rgb(22, 22, 22); width: 80%;">
            <h1>
                Votre profile :
            </h1>
            <br>

            <?php if ($is_admin) { ?>
                <p>
                    Pseudo : <?php echo $_SESSION['username']; ?>
                    <br><br>
                    Droits : <?php echo $_SESSION['rights']; ?>
                    <br><br>
                </p>
            <?php } else { ?>
                <p>
                    Nom : <?php echo $_SESSION['name']; ?>
                    <br><br>
                    Prénom : <?php echo $_SESSION['nickname']; ?>
                    <br><br>
                    Pseudo : <?php echo $_SESSION['username']; ?>
                    <br><br>
                    Age : <?php echo $_SESSION['age']; ?> ans
                    <br><br>
                    Téléphone : +687 <?php echo $_SESSION['phone']; ?>
                    <br><br>
                    Email : <?php echo $_SESSION['mail']; ?>
                    <br><br>
                </p>
            <?php } ?>
        </div>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
