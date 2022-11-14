<?php
    try {
        $database = new PDO("mysql:host=localhost; dbname=garage", "root", "");
        $database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $database -> query("SELECT * FROM voiture");
    }
    catch (Exception $e) {
        die("Erreur : " . $e -> getMessage());
    }

    if (isset($_GET["send_terme"]) AND $_GET["send_terme"] == "Rechercher") {
        $_GET["terme"] = htmlspecialchars($_GET["terme"]);  // Sécure contre failles
        $terme = $_GET["terme"];
        $terme = trim($terme);  // Supprime espaces
        $terme = strip_tags($terme); // Supprime balises html
    }

    $select_terme = "";
    if (isset($terme)) {
        $terme = strtolower($terme);  // Ecrit en minuscule
        $select_terme = $database -> prepare("SELECT * FROM voiture WHERE marque LIKE ? or modèle LIKE ?");
        $select_terme -> execute(array("%".$terme."%".$terme."%"));
    } else {
        $message = "Veuillez entrer votre requête dans la barre de recherche.";
    }

    while ($terme_trouve = $select_terme -> fetch()) {
        echo "<div><h2>".$terme_trouve['marque']." : ".$terme_trouve['modèle']."</h2><p>"
        .$terme_trouve."</p>";
    }
    $select_terme -> closeCursor();
