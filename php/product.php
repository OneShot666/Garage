<?php
    $resultat = Database();
    $database = $resultat[0];

    for ($i=1; $i<=6; $i++) {
        echo "<div class='product'>";
        echo "<h3>".$database[$i]['model']."</h3>";
        echo "<h4>".$database[$i]['brand']."</h4>";
        echo "<div>".$database[$i]['price']." &#8364;</div>";
        echo "<p>".$database[$i]['description']."</p>";
        echo "</div>";
    }
