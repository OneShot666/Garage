<?php /** @noinspection PhpUndefinedVariableInspection */
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    if (!isset($_SESSION['rights'])) {
        if (strpos($_SERVER['PHP_SELF'], '/include') or strpos($_SERVER['PHP_SELF'], '/php')) {
            header("Location: ../index.php");
        }
    }
    
    @$recherche = $_GET["recherche"];
    @$envoyer = $_GET["envoyer"];
    @$afficher = False;

    function DataByColumn($result1=array(), $dataname="car", $column="model") {
        $connexion = Connexion();
        @$recherche = $_GET["recherche"];
        @$envoyer = $_GET["envoyer"];
        $words = explode(" ", trim($recherche));                                // Accepte plusieurs mots
        for ($i=0; $i < count($words); $i++) {
            $word[$i] = "$column LIKE '%".$words[$i]."%'";
        }                           // "OR" : pour mots sans liens; "AND" : pour mots à la suite
        $result2 = $connexion->prepare("SELECT * FROM garage.$dataname WHERE ".implode(" OR ", $word));
        $result2->setFetchMode(PDO::FETCH_ASSOC);                               // Database en tableau associatif
        $result2->execute();
        $result2 = $result2->fetchAll();
        $results = array_merge($result1, $result2);
        return $results;
    }

    if (isset($envoyer) && !empty(trim($recherche))) {
        @$tableau = array();
        @$tableau = DataByColumn(@$tableau, "car", "brand");
        @$tableau = DataByColumn(@$tableau, "car", "model");
        @$tableau = DataByColumn(@$tableau, "car", "numberplate");
        @$tableau = DataByColumn(@$tableau, "car", "color");
        @$tableau = DataByColumn(@$tableau, "car", "price");
        @$afficher = True;
    }
?>

<div class="search_bar" style="color: lightgrey; font-size: medium;">
    <form name="search_form" action="" method="get">
        <label>
            <input type="search" name="recherche" value="<?php echo $recherche; ?>"
                   placeholder="Modèle(s) de voiture">
            <input type="submit" name="envoyer" value="Rechercher">
            <br>
        </label>
    </form>

    <?php if (@$afficher) { ?>
        <div id='results'>
            <div id='nb'>
                <?= count(@$tableau) . " " . (count(@$tableau) > 1 ? "résultats" : "résultat") ?>
            </div>

            <ul style="list-style-type: none;">
                <?php
                    for ($i=0; $i < count(@$tableau); $i++) {
                        echo "<li>" . @$tableau[$i]['brand'] . " " . @$tableau[$i]["model"] .
                        " : " . @$tableau[$i]["price"] . " &euro;</li>";
                    }
                ?>
            </ul>
        </div>
    <?php } ?>

    <br>
</div>

<br>
