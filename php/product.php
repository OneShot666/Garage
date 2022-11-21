<?php
    if (!$_SESSION['username']) { header("Location: ../index.php"); }
    $resultat = Database();
    $database = $resultat[0];

    for ($i=0; $i<count($database); $i++) {
        echo "<div class='product'>";
        echo "<h3>".$database[$i]['model']."</h3>";
        echo "<h5>".$database[$i]['brand']."</h5>";
        $nom_image = "car-".strtolower($database[$i]['brand'])."-".strtolower($database[$i]['model']).
                     "-fr ".strtolower($database[$i]["numberplate"]).".jpg";
        if (! file_exists("images/".$nom_image)) {
            $nom_image = "car-".strtolower($database[$i]['brand'])."-".strtolower($database[$i]['model']).
                         "-fr 0000.jpg'>";
        }
        $nom_image = "images/".$nom_image;
        echo "<img alt='Une voiture' src='$nom_image'>";
        echo "<div>".$database[$i]['price']." &#8364;</div>";
        echo "<p>".$database[$i]['description']."</p>";
        echo "</div>";
        if (($i + 1) % 4 == 0) {                                                // Chercher un retour à la ligne qui marche
            echo "<br><hr>";
        }
    }
