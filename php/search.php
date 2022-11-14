<?php /** @noinspection PhpUndefinedVariableInspection */
    @$recherche = $_GET["recherche"];
    @$envoyer = $_GET["envoyer"];
    @$afficher = False;

    if (isset($envoyer) && !empty(trim($recherche))) {
        $words = explode(" ", trim($recherche));  // Accepte plusieurs mots
        for ($i=0; $i < count($words); $i++) {
            $word[$i] = "modèle LIKE '%".$words[$i]."%'";
        }
        $connexion = Connexion();
        // "OR" : pour mots sans liens; "AND" : pour mots à la suite
        $results = $connexion->prepare("SELECT modèle FROM garage.voiture WHERE ".implode(" OR ", $word));
        $results->setFetchMode(PDO::FETCH_ASSOC);  // Database en tableau associatif
        $results->execute();
        @$tableau = $results->fetchAll();
        $afficher = True;
    }
?>

<div class="search_bar" style="color: lightgrey; font-size: medium;">
    <form name="search_form" action="" method="get">
        <label>
            <input type="text" name="recherche" value="<?php echo "$recherche"; ?>" placeholder="Entrer un ou plusieurs modèles">
            <input type="submit" name="envoyer" value="Rechercher">
            <br>
        </label>
    </form>

    <hr>

    <?php if (@$afficher) { ?>
        <div id='results'>
            <div id='nb'><?= count(@$tableau)." ".(count(@$tableau) > 1 ? "résultats" : "résultat") ?></div>

            <ol>
                <?php
                    for ($i=0; $i < count(@$tableau); $i++) {
                        echo "<li>".@$tableau[$i]['modèle'].", ".@$tableau[$i]["marque"]." : ".
                             @$tableau[$i]["prix"]." &euro;</li>";
                    }
                ?>
            </ol>
        </div>
    <?php } ?>

    <br>
</div>

<br>
