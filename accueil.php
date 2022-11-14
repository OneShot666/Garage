<?php
    include("php/fonction.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Accueil";
    $nav = "accueil";
?>

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

    <!--
    <pre style="text-align: left;">
        <?php print_r($_SERVER) ?>
    </pre>
    -->

	 <body class="accueil">
        <?php require_once "include/header.php" ?>

        <br>

        <h3>
            Bienvenue dans votre garage préféré !
        </h3>

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
