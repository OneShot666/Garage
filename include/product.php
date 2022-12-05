<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    if (!isset($_SESSION['rights'])) {
        if (strpos($_SERVER['PHP_SELF'], '/include') or strpos($_SERVER['PHP_SELF'], '/php')) {
            header("Location: ../index.php");
        }
    }

    $connexion = Connexion();
    $resultat = Database("car");                                                // Sélectionne toutes les voitures
    $database = $resultat[0];
    if ($is_connected) {
        $result = Database("user", "panier, favoris", "username='".$_SESSION["username"].
                        "' and password='".$_SESSION['password']."'");          // Sélectionne user connecté
        $user = $result[0][0];
    } else { $user = NULL; }

    for ($i=0; $i<count($database); $i++) {                                     // Affiche chaque voiture
        echo "<div class='product' id='".$database[$i]['id']."'>";
        echo "<h3>".$database[$i]['brand']." ".$database[$i]['model']."</h3>";

        if (isset($_POST["envoyer".$database[$i]["id"]])) {                     // Si bouton appuyé
            echo "<span style='color:green;'><strong>";                         // Affiche au dessus de l'image
            if ($_POST["envoyer".$database[$i]["id"]] == "Ajouter au panier") {
                if (isset($_SESSION['username']) and isset($_SESSION['panier'])) {  // Si connecté
                    if (strpos($user['panier'], $database[$i]['id']) === false) {   // Si ne contient pas id
                        $_SESSION['panier'] = $_SESSION['panier']." ".$database[$i]['id'];  // Modifie la session
                        $sql="UPDATE garage.user SET panier=? WHERE username='".$_SESSION['username'].
                            "' and password='".$_SESSION['password']."'";
                        $requete = $connexion->prepare($sql);
                        $requete->execute(array($_SESSION['panier']));          // Modifie la base de données
                        echo $database[$i]['brand']." ".$database[$i]['model']." ajouté à votre panier !";
                    }
                } else {
                    echo "Vous devez être connecté pour pouvoir ajouter un produit à votre panier !";
                }
            } else if ($_POST["envoyer".$database[$i]["id"]] == "Ajouter aux favoris") {
                if (isset($_SESSION['username']) and isset($_SESSION['favoris'])) {
                    if (strpos($user['favoris'], $database[$i]['id']) === false) {
                        $_SESSION['favoris'] = $_SESSION['favoris']." ".$database[$i]['id'];
                        $sql="UPDATE garage.user SET favoris=? WHERE username='".$_SESSION['username'].
                            "' and password='".$_SESSION['password']."'";
                        $requete = $connexion->prepare($sql);
                        $requete->execute(array($_SESSION['favoris']));
                        echo $database[$i]['brand']." ".$database[$i]['model']." ajouté à vos favoris !";
                    }
                } else {
                    echo "Vous devez être connecté pour pouvoir ajouter un produit à vos favoris !";
                }
            } else if ($_POST["envoyer".$database[$i]["id"]] == "Retirer du panier") {
                if ($is_connected and isset($user)) {                           // Test autre condition
                    if (strpos($user['panier'], $database[$i]['id']) !== false) {   // Si contient id
                        $_SESSION['panier'] = str_replace(" ".$database[$i]['id'], "", $_SESSION['panier']);// Retire id
                        $sql="UPDATE garage.user SET panier=? WHERE username='".$_SESSION['username'].
                            "' and password='".$_SESSION['password']."'";
                        $requete = $connexion->prepare($sql);
                        $requete->execute(array($_SESSION['panier']));
                        echo $database[$i]['brand']." ".$database[$i]['model']." retiré de votre panier !";
                    }
                }
            } else if ($_POST["envoyer".$database[$i]["id"]] == "Retirer des favoris") {
                if ($is_connected and isset($user)) {
                    if (strpos($user['favoris'], $database[$i]['id']) !== false) {
                        $_SESSION['favoris'] = str_replace(" ".$database[$i]['id'], "", $_SESSION['favoris']);
                        $sql="UPDATE garage.user SET favoris=? WHERE username='".$_SESSION['username'].
                            "' and password='".$_SESSION['password']."'";
                        $requete = $connexion->prepare($sql);
                        $requete->execute(array($_SESSION['favoris']));
                        echo $database[$i]['brand']." ".$database[$i]['model']." retiré de vos favoris !";
                    }
                }
            }
            echo "</strong></span>";
            unset($_POST["envoyer".$database[$i]["id"]]);                       // Empêche l'envoie pour ts autres produits
        }

        $path = "images/car/";
        $nom_image = "car-".strtolower($database[$i]['brand'])."-".
                            strtolower($database[$i]['model'])."-fr ".
                            strtolower($database[$i]["numberplate"]).".jpg";
        if (! file_exists($path.$nom_image)) {                                  // Si ne trouve pas l'image
            $nom_image = "car-".strtolower($database[$i]['brand'])."-".
                                strtolower($database[$i]['model'])."-fr 0000.jpg";
        }
        if (! file_exists($path.$nom_image)) {                                  // Si ne trouve toujours pas l'image
            $nom_image = "icon.svg";
        }
        $nom_image = $path.$nom_image;
        echo "<img alt='".$database[$i]['description']."' src='$nom_image' style='height=150px'>";
        echo "<h3>".$database[$i]['price']." &#8364;</h3>";
        echo "<h4>Numéro d'immatriculation : ".$database[$i]['numberplate']."fr<br>";
        if ($database[$i]['horsepower'] != 0) {                                 // Si puissance moteur
            echo "Puissance : ".$database[$i]['horsepower']." ch<br>";
        }
        if ($database[$i]['color'] != "") {                                     // Si a couleur
            echo "Couleur : ".$database[$i]['color']."<br>";
        }
        $year = ($database[$i]['age'] <= 1) ? "an" : "ans";
        echo "Age : ".$database[$i]['age']." $year<br>";
        echo "Arrivé au garage : ".$database[$i]['inscription_date']."</h4>";
        if ($database[$i]['description'] != "") {                               // Si a description
            echo "<p>".$database[$i]['description']."</p>";
        }

        if (isset($user['panier']) and strpos($user['panier'], $database[$i]['id']) !== false) {  // Si contient id
            echo "<form action='' method='post'><input type='submit' name='envoyer".$database[$i]["id"]."'
                value='Retirer du panier'></input></form>";
        } else {
            echo "<form action='' method='post'><input type='submit' name='envoyer".$database[$i]["id"]."'
                value='Ajouter au panier'></input></form>";
        }
        if (isset($user['favoris']) and strpos($user['favoris'], $database[$i]['id']) !== false) {
            echo "<form action='' method='post'>☆<input type='submit' name='envoyer".$database[$i]["id"]."'
                value='Retirer des favoris'></input></form>";
        } else {
            echo "<form action='' method='post'>☆<input type='submit' name='envoyer".$database[$i]["id"]."'
                value='Ajouter aux favoris'></input></form>";
        }

        echo "</div>";
    }
