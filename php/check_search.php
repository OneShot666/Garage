<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    if (!isset($_SESSION['rights'])) {
        if (strpos($_SERVER['PHP_SELF'], '/css') or strpos($_SERVER['PHP_SELF'], '/data') or
        strpos($_SERVER['PHP_SELF'], '/images') or strpos($_SERVER['PHP_SELF'], '/include') or
        strpos($_SERVER['PHP_SELF'], '/php')) {
            header("Location: ../index.php");
        }
    }

    try {
        $database = new PDO("mysql:host=localhost; dbname=garage", "root", "");
        $database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $database -> query("SELECT * FROM garage.car");
    }
    catch (Exception $e) { die("Erreur : " . $e->getMessage()); }

    if (isset($_GET["send_terme"]) AND $_GET["send_terme"] == "Rechercher") {
        $terme = htmlspecialchars($_GET["terme"]);                              // Sécure contre failles
        $terme = trim($terme);                                                  // Supprime espaces
        $terme = strip_tags($terme);                                            // Supprime balises html
    }

    $select_terme = "";
    if (isset($terme)) {
        $terme = strtolower($terme);                                            // Ecrit en minuscule
        $select_terme = $database->prepare("SELECT * FROM garage.car WHERE brand LIKE ? or model LIKE ?");
        $select_terme -> execute(array($terme, $terme));
    } else { echo "Veuillez entrer votre requête dans la barre de recherche."; }

    while ($terme_trouve = $select_terme -> fetch()) {                          // Affiche résultat(s) recherche
        echo "<div><h2>".$terme_trouve['brand']." : ".$terme_trouve['model']."</h2><p>"
        .$terme_trouve."</p>";
    }
    $select_terme -> closeCursor();

    // header("location:products.php");                                            // Renvoie vers page
