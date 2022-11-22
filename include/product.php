<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    // if (!$_SESSION['username']) { header("Location: ../index.php"); }
    $resultat = Database();
    $database = $resultat[0];

    for ($i=0; $i<count($database); $i++) {
        echo "<div class='product'>";
        echo "<h3>".$database[$i]['brand']." ".$database[$i]['model']."</h3>";
        $nom_image = "car-".strtolower($database[$i]['brand'])."-".strtolower($database[$i]['model']).
                     "-fr ".strtolower($database[$i]["numberplate"]).".jpg";
        if (! file_exists("images/".$nom_image)) {                              // Si ne trouve pas l'image
            $nom_image = "car-".strtolower($database[$i]['brand'])."-".strtolower($database[$i]['model']).
                         "-fr 0000.jpg";
        }
        if (! file_exists("images/".$nom_image)) {                              // Si ne trouve toujours pas l'image
            $nom_image = "icon.svg' style='height=150px";
        }
        $nom_image = "images/".$nom_image;
        echo "<img alt='".$database[$i]['description']."' src='$nom_image'>";
        echo "<h3>".$database[$i]['price']." &#8364;</h3>";
        echo "<p>".$database[$i]['description']."</p>";
        echo "</div>";
        // if (($i + 1) % 4 == 0) { echo "<br><hr>"; }                             // Chercher un retour à la ligne qui marche
    }
