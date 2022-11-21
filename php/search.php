<?php /** @noinspection PhpUndefinedVariableInspection */
    if (!$_SESSION['username']) { header("Location: ../index.php"); }
    @$recherche = $_GET["recherche"];
    @$envoyer = $_GET["envoyer"];
    @$afficher = False;

    if (isset($envoyer) && !empty(trim($recherche))) {
        $words = explode(" ", trim($recherche));  // Accepte plusieurs mots
        for ($i=0; $i < count($words); $i++) {
            $word[$i] = "model LIKE '%".$words[$i]."%'";
        }
        $connexion = Connexion();
        // "OR" : pour mots sans liens; "AND" : pour mots à la suite
        $results = $connexion->prepare("SELECT * FROM garage.car WHERE ".implode(" OR ", $word));
        $results->setFetchMode(PDO::FETCH_ASSOC);  // Database en tableau associatif
        $results->execute();
        @$tableau = $results->fetchAll();
        $afficher = True;
    }
?>

<div class="search_bar" style="color: lightgrey; font-size: medium;">
    <form name="search_form" action="" method="get">
        <label>
            <input type="text" name="recherche" value="<?php echo $recherche; ?>"
                   placeholder="Modèle(s) de voiture">
            <input type="submit" name="envoyer" value="Rechercher">
            <br>
        </label>
    </form>

    <hr>

    <?php if (@$afficher) { ?>
        <div id='results'>
            <div id='nb'>
                <?= count(@$tableau) . " " . (count(@$tableau) > 1 ? "résultats" : "résultat") ?>
            </div>

            <ol>
                <?php
                    for ($i=0; $i < count(@$tableau); $i++) {
                        echo "<li>" . @$tableau[$i]['brand'] . " " . @$tableau[$i]["model"] .
                        " : " . @$tableau[$i]["price"] . " &euro;</li>";
                    }
                ?>
            </ol>
        </div>
    <?php } ?>

    <br>
</div>

<br>
