<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Accueil";
    $nav = "accueil";
?>

<!-- (css) Faire des banderoles (use all width of pages) pour meilleure présentation ? -->
<!-- (css) Améliorer le css : header, footer, search, profile, products (tabs), about -->
<<<<<<< HEAD
<!-- (css) Ajouter commentaires derière voiture : en faire des cartes -->
<!-- (css) Ajouter boutons dans afficher un seul form x3 dans admin -->
<!-- (css) Mettre les produits affichés (ds index) sous barre de recherche -->

<!-- (php) Améliorer pattern dans forms -->
<!-- (php) Ajouter personnaliser compte user (photo, modifier password, etc) -->
<!-- (php) Rendre le site personnalisable si je suis connecté (refresh, admin, ...) -->
<!-- (php) Ajouter vérification et nettoyage de la base de données (doublons, format, ids panier, etc) -->
<!-- (php) Qd finitions site, nettoyer code (répétitions, mess en EN, guillemets,
           supprimer code/fichiers inutiles, etc) -->

<!-- (sql) Adapter le code à data/garage.sql ou à data/garage/* -->
<<<<<<< HEAD
<!-- (js) Use js pour formulaires (afficher et vérif data) et défilmt auto -->
=======
=======
<!-- (sql) Adapter le code à data/garage.sql ou à data/garage/* -->

<!-- (php) Ajouter personnaliser compte user (photo, modifier password, etc) -->
<!-- (php) Ajouter afficher cars selon recherche (fusionner search & product ?) -->
<!-- (css) Ajouter boutons dans afficher un seul form x3 dans admin -->
<!-- (css) Ajouter commentaires derière voiture : en faire des cartes -->
<!-- (php) Rendre le site personnalisable si je suis connecté (refresh, admin, ...) -->

<!-- Redéfinir les erreurs systèmes -->
<!-- (php) Ajouter vérification et nettoyage de la base de données (doublons, format, etc) -->
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
<!-- (js) Use pour formulaires (afficher et vérif data) et défilmt auto -->
>>>>>>> 73efe1e518605350820b74d46952fcad8e7eb7e9
<!-- (js) Pour form car, add jointure ? (lien marque-modèle) -->

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
            <h1>
                Bienvenue dans votre garage préféré !
            </h1>

            <h3>
	            Choisissez la voiture de vos rêves !<br>
                Nous vous présentons nos meilleurs modèles.
    		</h3>
    		<br>

            <h1>
                Nos modèles
            </h1>
            <br>

            <div class="all_products">
                <?php require_once "include/search.php" ?>
            </div>
        </main>
		<br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
