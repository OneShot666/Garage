<?php
    include("php/function.php");
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Mentions légales";
    $nav = "notice";
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

    <body class="about">
        <?php require_once "include/header.php" ?>
        <br>

      	<h1>
      		Mentions légales
      	</h1>

        <span style="float: left; height: auto;" id="notice">
            <h2>
                Qui a développé le site <?= $nom_du_site; ?> ?
            </h2>
            <br>

            <h3>
                Editeur du site
            </h3>

            <p>
                Nathan Mir
            </p>
            <br>

            <h3>
                Status
            </h3>

            <p>
                Développeur junior en formation personnelle continue.
            </p>
            <br>

            <h3>
                Ses coordonnées
            </h3>

            <p>
                Téléphone : +687 92.11.12<br>
                Adresse professionnelle : <a href="mailto:mir.nathan42@gmail.com">mir.nathan42@gmail.com</a>
            </p>
            <br>
        </span>
        <br>

        <span style="float: left; height: auto;" id="charter">
            <h2>
                Comment sont traitées les données par le site ?
            </h2>
            <br>

            <h3>
                Informations commerciales (CGV)
            </h3>

            <p>
                Bien que le site puisse en donner l'impression, il n'est pas utilisé à des fins commerciales.<br>
                Les utilisateurs de ce site n'ont aucune obligation financière.
            </p>
            <br>

            <h3>
                Les cookies
            </h3>

            <p>
                Les informations obtenues sont seulement celles que les utilisateurs
                entrent dans le formulaire d'inscription.<br>
                Aucune autre information n'est stockée et aucune donnée n'est partagée
                avec d'autre site ou association.<br>
                Le site <?= $nom_du_site; ?> décline toutes responsabilités en cas
                de perte de données ou des coptes de ses utilisateurs.
            </p>
            <br>

            <h3>
                Mentions annexes
            </h3>

            <p>
                Ce site respecte la vie privée de ses utilisateurs.<br>
                Les utilisateurs non inscrits peuvent visiter les différentes pages
                du site et ainsi voir les produits présentés sur le site.<br>
                Ils peuvent nous contacter pour donner leur avis ou signaler un problème sur le site.<br>
                Ils peuvent aussi s'inscrire pour pouvoir ajouter des produits à
                leur liste de produits favoris et les ajouter à leur panier.<br>
            </p>
            <br>
        </span>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
