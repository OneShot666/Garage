<?php /** @noinspection PhpUndefinedVariableInspection */
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    if (!isset($_SESSION['rights'])) {
        if (strpos($_SERVER['PHP_SELF'], '/include') or strpos($_SERVER['PHP_SELF'], '/php')) {
            header("Location: ../index.php");
        }
    }

    function DataByColumn($result1=array(), $dataname="car", $column="*", $condition="1") {
        $connexion = Connexion();
        if ($condition == "1") {
            $result2 = $connexion->prepare("SELECT $column FROM garage.$dataname WHERE $condition");
        } else {
            $words = explode(" ", trim($condition));                            // Accepte plusieurs mots
            for ($i=0; $i < count($words); $i++) {
                $word[$i] = "$column LIKE '%".$words[$i]."%'";
            }           // "OR" : pour mots sans liens; "AND" : pour mots à la suite
            $result2 = $connexion->prepare("SELECT * FROM garage.$dataname WHERE ".implode(" OR ", $word));
        }
        $result2->setFetchMode(PDO::FETCH_ASSOC);                               // Database en tableau associatif
        $result2->execute();
        $result2 = $result2->fetchAll();
        foreach ($result2 as $key => $value) {                                  // Empêche les doublons
            if (!in_array($value, $result1)) array_push($result1, $value);      // Si pas dedans, l'ajoute
        }
        return $result1;
    }

    @$recherche = (isset($_GET["envoyer"])) ? $_GET["recherche"] : "1";
    $affiche = (@$recherche == "1") ? "Modèle(s) de voiture" : @$recherche;
    @$database = array();
    if (@$recherche == "1") {                                                   // ! Si recherche rien, affiche tout
        @$database = DataByColumn(@$database, "car", "*", @$recherche);
    } else {
        @$database = DataByColumn(@$database, "car", "brand", @$recherche);
        @$database = DataByColumn(@$database, "car", "model", @$recherche);
    }
?>

<div class="search_bar" style="color: lightgrey; font-size: medium;">
    <form name="search_form" action="" method="get">
        <label>
            <input type="search" name="recherche" placeholder="<?= $affiche; ?>">
            <input type="submit" name="envoyer" value="Rechercher">
            <br>
        </label>
    </form>

    <?php if (isset($_GET['envoyer'])) { ?>
        <div id='results'>
            <div id='nb'>
                <?= count(@$database)." ".(count(@$database) > 1 ? "résultats" : "résultat") ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php
if (count(@$database) > 0) {
    for ($i=0; $i < count(@$database); $i++) {
        echo "<div class='product' id='".$database[$i]['id']."'>";
        echo "<h3>".$database[$i]['brand']." ".$database[$i]['model']."</h3>";

        if (isset($_GET["envoyer".$database[$i]["id"]])) {                      // Si bouton appuyé
            if ($_SESSION['banned']) {                                          // Si compte suspendu
                echo "<span style='color:red;'><strong>Vous ne pouvez pas faire ça !</strong></span>";
            } else {
                $connexion = Connexion();
                echo "<span style='color:green;'><strong>";                     // Affiche au dessus de l'image
                if ($_GET["envoyer".$database[$i]["id"]] == "Ajouter au panier") {
                    if (isset($_SESSION['username']) and isset($_SESSION['panier'])) {  // Si connecté
                        if (strpos($_SESSION['panier'], $database[$i]['id']) === false) {   // Si ne contient pas id
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
                } else if ($_GET["envoyer".$database[$i]["id"]] == "Ajouter aux favoris") {
                    if (isset($_SESSION['username']) and isset($_SESSION['favoris'])) {
                        if (strpos($_SESSION['favoris'], $database[$i]['id']) === false) {
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
                } else if ($_GET["envoyer".$database[$i]["id"]] == "Retirer du panier") {
                    if ($is_connected and isset($_SESSION)) {                           // Test autre condition
                        if (strpos($_SESSION['panier'], $database[$i]['id']) !== false) {   // Si contient id
                            $_SESSION['panier'] = str_replace(" ".$database[$i]['id'], "", $_SESSION['panier']);// Retire id
                            $sql="UPDATE garage.user SET panier=? WHERE username='".$_SESSION['username'].
                            "' and password='".$_SESSION['password']."'";
                            $requete = $connexion->prepare($sql);
                            $requete->execute(array($_SESSION['panier']));
                            echo $database[$i]['brand']." ".$database[$i]['model']." retiré de votre panier !";
                        }
                    }
                } else if ($_GET["envoyer".$database[$i]["id"]] == "Retirer des favoris") {
                    if ($is_connected and isset($_SESSION)) {
                        if (strpos($_SESSION['favoris'], $database[$i]['id']) !== false) {
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
            }
            unset($_GET["envoyer".$database[$i]["id"]]);                        // Empêche l'envoie pour ts autres produits
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

        if (isset($_SESSION['panier']) and strpos($_SESSION['panier'], $database[$i]['id']) !== false) {  // Si contient id
            echo "<form action='' method='get'><input type='submit' name='envoyer".$database[$i]["id"].
                "' value='Retirer du panier'></input></form>";
        } else {
            echo "<form action='' method='get'><input type='submit' name='envoyer".$database[$i]["id"].
                "' value='Ajouter au panier'></input></form>";
        }
        if (isset($_SESSION['favoris']) and strpos($_SESSION['favoris'], $database[$i]['id']) !== false) {
            echo "<form action='' method='get'>☆<input type='submit' name='envoyer".$database[$i]["id"].
                "' value='Retirer des favoris'></input></form>";
        } else {
            echo "<form action='' method='get'>☆<input type='submit' name='envoyer".$database[$i]["id"].
                "' value='Ajouter aux favoris'></input></form>";
        }

        echo "</div>";
    }
} else {
    echo "<p>Nous n'avons aucun produit avec cette marque ou ce modèle !<br>";
    echo "Veuillez vérifier l'orthographe ou effectuez une autre recherche.</p>";
} ?>
<br>
