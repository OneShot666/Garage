<?php
    try {
        $database = new PDO("mysql:host=localhost; dbname=garage", "root", "");
        $database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $database -> query("SELECT * FROM admin");
    }
    catch (Exception $e) {
        die("Erreur : " . $e -> getMessage());
    }

    if (isset($_GET["envoyer"]) AND $_GET["envoyer"] == "Envoyer") {
        $_GET["speudo"] = htmlspecialchars($_GET["speudo"]);  // Sécure contre failles
        $speudo = $_GET["speudo"];
        $speudo = strip_tags($speudo); // Supprime balises html
        $_GET["password"] = htmlspecialchars($_GET["password"]);  // Sécure contre failles
        $password = $_GET["password"];
        $password = strip_tags($password); // Supprime balises html
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

    // header("location:products.php");  // Renvoie vers page
