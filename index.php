<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Accueil";
    $nav = "accueil";
?>

<!-- Faire des banderoles (use all width of pages) pour meilleure présentation ? -->
<!-- Améliorer le css : header, footer, search, profile, products (tabs), about -->
<!-- Adapter le code à data/garage.sql ou à data/garage/* -->
<!-- Améliorer les droits admins (rwx), prévenir et vérifier -->

<!-- Ajouter personnaliser compte (photo, modifier password, etc) -->
<!-- Ajouter afficher voitures en fonction recherche -->
<!-- Ajouter boutons dans afficher un seul form x3 dans admin -->
<!-- Ajouter commentaires derière voiture : en faire des cartes -->
<!-- Rendre le site personnalisable si je suis connecté (refresh, admin, ...) -->

<!-- Redéfinir les erreurs systèmes -->
<!-- Ajouter vérification et nettoyage de la base de données (doublons, format, etc) -->
<!-- Quand add JS, use pour formulaires (afficher et vérif data) et défilmt auto -->
<!-- Pour form car, add jointure ? (lien marque-modèle) -->

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

    <body class="accueil">
        <?php require_once "include/header.php" ?>
        <br>

        <main>
            <h2>
                Bienvenue dans votre garage préféré !
            </h2>

            <p>
	            Choisissez la voiture de vos rêves !
                <br>
                Nous vous présentons nos meilleurs modèles.
    		</p>
    		<br>

            <h1>
                Nos modèles
            </h1>
            <br>

            <?php require_once "include/search.php" ?>
            <br>

            <div class="all_products">
                <?php require_once "include/product.php" ?>
    		</div>
        </main>
		<br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
