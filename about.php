<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - A propos";
    $nav = "about";
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

    <body class="about">
        <?php require_once "include/header.php" ?>

        <br>

      	<h1>
      		A propos de nous :
      	</h1>

        <span style="float: left; height: auto;">
            <h3>
                Qui sommes-nous ?
            </h3>

            <p>
                Nous sommes une équipe de garagistes, certains experts, d'autres débutants.<br>
                Tous passionnés, nous entretenons des relations aussi bien professionnelles qu'amicales.<br>
            </p>
        </span>

        <span style="float: right; height: auto;">
            <h3>
                Quels services offrons-nous ?
            </h3>

            <p>
                Nous nous efforçons de donner le meilleur de nous-mêmes afin de satisfaire au mieux nos clients.<br>
                Nous proposons une gamme de voiture de toutes époques et de tous modèles.<br>
                Vous pouvez la consulter à tout moment en fonction de vos envies.<br>
                Si vous créez un compte, vous pourrez ajouter vos modèles préférés à votre liste de favoris,
                louer et même acheter nos modèles de voitures.
            </p>
        </span>

        <span style="float: left; height: auto;">
            <h3>
                En savoir plus
            </h3>

            <p>
                Pour plus d'informations, vous pouvez visiter nos réseaux sociaux<br>
                ou contacter un de nos employés via son compte Facebook ou LinkedIn.<br>
            </p>
        </span>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
