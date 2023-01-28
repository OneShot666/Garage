<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Accueil";
    $nav = "accueil";
?>

<!-- Faire une fonction (arg -> $nav) pour le php en début de programme ? -->
<!-- Empêcher de mettre n'importe quoi dans l'url : limiter accès -->
<!-- Créer document src ? -> mettre tous .php pages dedans ? -->
<!-- Faire des banderoles (use all width of pages) pour meilleure présentation ? -->
<!-- Adapter le code à data/garage.sql -->
<!-- Améliorer le css : footer, search, profile, about -->
<!-- Mettre logo pour réseaux sociaux -->
<!-- Ajouter charte + mentions -->
<!-- Ajouter personnaliser compte (photo, modifier password, etc) -->
<!-- Redéfinir les erreurs -->
<!-- Ajouter champ vérif password -->
<!-- Ajouter dans database table brand avec column model -->
<!-- Pour form car, add jointure ? -->
<!-- Ajouter sauvergader/restaurer versions site -->
<!-- Mettre à jour la documentation (use export/import + command pour git bash) -->

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

            <?php require_once "include/search.php" ?>

            <h1>
                Nos modèles
            </h1>

            <div class="all_products">
                <?php require_once "include/product.php" ?>
        		</div>
        </main>
    		<br>

        <?php require_once "include/footer.php" ?>
	  </body>
</html>
