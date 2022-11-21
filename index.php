<?php
    session_start();
    include("php/function.php");
    Connexion();
    $page_name = $nom_du_site . " - Accueil";
    $nav = "accueil";
?>

<!-- Faire une fonction (arg -> $nav) pour le php en début de programme ? -->
<!-- Empêcher de mettre n'importe quoi dans l'url : limiter accès -->
<!-- Créer document src ? -> mettre tous .php pages dedans -->
<!-- Faire des banderoles (use all width of pages) pour meilleure présentation -->

<!DOCTYPE html>

<html lang="fr">
    <head>
		    <title>
		       <?php echo $page_name; ?>
        </title>
	      <meta charset="utf-8">
            <link rel="icon" type="image/png" href="https://ionic.io/ionicons">
            <ion-icon name="car-sport-outline"></ion-icon>
            <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>

	 <body class="accueil">
        <?php require_once "include/header.php" ?>
        <br>

        <h2>
            Bienvenue dans votre garage préféré !
        </h2>

        <p>
			     Choisissez la voiture de vos rêves !
           <br>
           Nous vous présentons nos meilleurs modèles.
    		</p>

    		<hr>
    		<br>

        <?php require_once "php/search.php" ?>

        <h3>
            Nos modèles
        </h3>
        <br>

        <div class="all_products">
            <?php require_once "php/product.php" ?>
    		</div>
    		<br>

        <?php require_once "include/footer.php" ?>
	  </body>
</html>
