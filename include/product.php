<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    if (!isset($_SESSION['rights'])) {
        if (strpos($_SERVER['PHP_SELF'], '/include') or strpos($_SERVER['PHP_SELF'], '/php')) {
            header("Location: ../index.php");
        }
    }

    $resultat = Database();
    $database = $resultat[0];

    for ($i=0; $i<count($database); $i++) {
        echo "<div class='product'>";
        echo "<h3>".$database[$i]['brand']." ".$database[$i]['model']."</h3>";
        $nom_image = "car-".strtolower($database[$i]['brand'])."-".strtolower($database[$i]['model']).
                     "-fr ".strtolower($database[$i]["numberplate"]).".jpg";
        if (! file_exists("images/car/".$nom_image)) {                          // Si ne trouve pas l'image
            $nom_image = "car-".strtolower($database[$i]['brand'])."-".strtolower($database[$i]['model']).
                         "-fr 0000.jpg";
        }
        if (! file_exists("images/car/".$nom_image)) {                          // Si ne trouve toujours pas l'image
            $nom_image = "icon.svg' style='height=150px";
        }
        $nom_image = "images/car/".$nom_image;
        echo "<img alt='".$database[$i]['description']."' src='$nom_image'>";
        echo "<h4>Numéro d'immatriculation : ".$database[$i]['numberplate']."fr</h4>";
        if ($database[$i]['horsepower'] != 0) {
            echo "<h4>Puissance : ".$database[$i]['horsepower']." ch</h4>";
        }
        if ($database[$i]['color'] != "") {
            echo "<h4>Couleur : ".$database[$i]['color']."</h4>";
        }
        echo "<h4>Age : ".$database[$i]['age']." ans</h4>";
        echo "<h4>Arrivé au garage : ".$database[$i]['inscription_date']."</h4>";
        echo "<h3>".$database[$i]['price']." &#8364;</h3>";
        if ($database[$i]['description'] != "") {
            echo "<p>".$database[$i]['description']."</p>";
        }
        echo "<form><input type='submit' value='Ajouter aux favoris'></input></form>";
        echo "</div>";
    }
