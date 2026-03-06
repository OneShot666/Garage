<?php
    $resultat = Database();
    $database = $resultat[0];

    for ($i=0; $i<count($database); $i++) {
        echo "<div class='product'>";
        echo "<h3>".$database[$i]['modèle']."</h3>";
        echo "<h5>".$database[$i]['marque']."</h5>";
        $nom_image = "car-".strtolower($database[$i]['marque'])."-".strtolower($database[$i]['modèle']).
                     "-".strtolower($database[$i]["numéro d'immatriculation"]).".jpg";
        if (! file_exists("Images/".$nom_image)) {
            $nom_image = "car-".strtolower($database[$i]['marque'])."-".strtolower($database[$i]['modèle']).
                         "-fr 0000.jpg'>";
        }
        $nom_image = "Images/".$nom_image;
        echo "<img alt='Une voiture' src='$nom_image'>";
        echo "<div>".$database[$i]['prix']." &#8364;</div>";
        echo "<p>".$database[$i]['description']."</p>";
        echo "</div>";
        if (($i + 1) % 4 == 0) {                                                // Chercher un retour à la ligne qui marche
            echo "<br><hr>";
        }
    }
