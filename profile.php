<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - Profil";
    $nav = "profile";
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?= $page_name; ?>
        </title>
        <meta charset="utf-8">
            <link rel="icon" type="image/png" href="images/car/icon.svg"><!--https://ionic.io/ionicons"-->
            <!--ion-icon name="car-sport-outline"></ion-icon-->
            <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
        <?php require_once "include/header.php" ?>

        <br>

        <div class="formulaire" style="color: rgb(22, 22, 22); text-align: left; width: 80%;" id="profile">
            <h1>
                Votre profil :
            </h1>
            <br>

            <h3>
                <?php if ($is_admin) {                      //Si admin ?>
                    Pseudo : <?= $_SESSION['username']; ?>
                    <br><br>
                    Droits :
                    <br>
                    <?php
                        $testa = is_letter_in_word($_SESSION['rights'], "a");
                        $testtiret = is_letter_in_word($_SESSION['rights'], "-");
                        $testr = is_letter_in_word($_SESSION['rights'], "r");
                        $testw = is_letter_in_word($_SESSION['rights'], "w");
                        $testx = is_letter_in_word($_SESSION['rights'], "x");
                        if ($testa and !$testtiret) { echo "Vous avez tous les droits adminisateurs.<br>"; }
                        else if ($testr or $testw or $testx) {
                            if ($testr) { echo "Vous avez le droit de visiter des pages spéciales.<br>"; }
                            if ($testw) { echo "Vous avez le droit d'utiliser les formulaires des pages spéciales.<br>"; }
                            if ($testx) { echo "Vous avez le droit d'envoyer les formulaires des pages spéciales.<br>"; }
                        } else { echo "Vous n'avez aucun droit adminisateur.<br>"; }
                    ?>
                <?php } else {                              // Si user ?>
                    Nom : <?= $_SESSION['name']; ?>
                    <br><br>
                    Prénom : <?= $_SESSION['nickname']; ?>
                    <br><br>
                    Pseudo : <?= $_SESSION['username']; ?>
                    <br><br>
                    Age : <?= $_SESSION['age']; ?> ans
                    <br><br>
                    Téléphone : +687 <?= get_form_phone($_SESSION['phone']); ?>
                    <br><br>
                    Email : <?= $_SESSION['mail']; ?>
                    <br>
                <?php } ?>
            </h3>
        </div>
        <br>

        <?php if (isset($_SESSION['favoris'])) {    // Si user a des produits favoris ?>
            <div class="formulaire" style="color: rgb(22, 22, 22); width: 80%;" id="favoris">
                <h1>
                    Vos favoris :
                </h1>
                <br>

                <div class="all_products">
                <?php
                    $condition = "username='".$_SESSION['username']."' and
                    password='".$_SESSION['password']."'";
                    $results = Database("user", "favoris", $condition);
                    $fav = $results[0];
                    $fav = explode(" ", $fav[0]['favoris']);                    // Transforme nbs en tableau
                    $fav = array_unique($fav);                                  // Si doublons, les retire
                    if (in_array("0", $fav)) { unset($fav[array_search("0", $fav)]); }  // Si zéro, le retire
                    sort($fav);                                                 // Tri tableau

                    if (count($fav) > 0 and $fav[0] != "0") {                   // Si au moins un favoris
                        foreach ($fav as $key => $value) {
                            $resultat = CarPart("select", "*", "id='".$value."'");// Cherche par id
                            $database = $resultat[0];
                            echo "<div class='product'>";
                            echo "<h3>".$database[0]['brand']." ".$database[0]['model']."</h3>";
                            $nom_image = "car-".strtolower($database[0]['brand'])."-".
                                                strtolower($database[0]['model'])."-fr ".
                                                strtolower($database[0]["numberplate"]).".jpg";
                            if (! file_exists("images/car/".$nom_image)) {      // Si ne trouve pas l'image
                                $nom_image = "car-".strtolower($database[0]['brand'])."-".
                                                    strtolower($database[0]['model'])."-fr 0000.jpg";
                            }
                            if (! file_exists("images/car/".$nom_image)) {      // Si ne trouve toujours pas l'image
                                $nom_image = "icon.svg";
                            }
                            $nom_image = "images/car/".$nom_image;
                            echo "<img alt='".$database[0]['description']."' src='$nom_image'
                                  style='height=150px'>";
                            echo "<h3>".$database[0]['price']." &#8364;</h3>";
                            echo "<h4>Numéro d'immatriculation : ".$database[0]['numberplate']."fr<br>";
                            if ($database[0]['horsepower'] > 0) {
                                echo "Puissance : ".$database[0]['horsepower']." ch<br>";
                            }
                            if ($database[0]['color'] != "") {
                                echo "Couleur : ".$database[0]['color']."<br>";
                            }
                            echo "Age : ".$database[0]['age']." ans<br>";
                            echo "Arrivé au garage : ".$database[0]['inscription_date']."</h4>";
                            echo "<p>".$database[0]['description']."</p>";
                            echo "<form><input type='submit' value='Retirer des favoris'></input></form>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Vous n'avez aucun favoris pour le moment.<br>
                        Accèdez à notre panoplie de modèle <a href='index.php'>ici</a> !</p>";
                    } ?>
                </div>
            </div>
            <br>
        <?php } ?>

        <?php if (isset($_SESSION['panier'])) {     // Si user a des produits au panier ?>
            <div class="formulaire" style="color: rgb(22, 22, 22); width: 80%;" id="panier">
                <h1>
                    Votre panier :
                </h1>
                <br>

                <div class="all_products">
                <?php
                    $condition = "username='".$_SESSION['username']."' and
                    password='".$_SESSION['password']."'";
                    $results = Database("user", "panier", $condition);
                    $pan = $results[0];
                    $pan = explode(" ", $pan[0]['panier']);                     // Transforme nbs en tableau
                    $pan = array_unique($pan);                                  // Si doublons, les retire
                    if (in_array("0", $pan)) { unset($pan[array_search("0", $pan)]); }  // Si zéro, le retire
                    sort($pan);                                                 // Tri tableau

                    if (count($pan) > 0 and $pan[0] != "0") {                   // Si au moins un élément
                        foreach ($pan as $key => $value) {
                            $resultat = CarPart("select", "*", "id='".$value."'");// Cherche par id
                            $database = $resultat[0];
                            echo "<div class='product'>";
                            echo "<h3>".$database[0]['brand']." ".$database[0]['model']."</h3>";
                            $nom_image = "car-".strtolower($database[0]['brand'])."-".
                                                strtolower($database[0]['model'])."-fr ".
                                                strtolower($database[0]["numberplate"]).".jpg";
                            if (! file_exists("images/car/".$nom_image)) {      // Si ne trouve pas l'image
                                $nom_image = "car-".strtolower($database[0]['brand'])."-".
                                                    strtolower($database[0]['model'])."-fr 0000.jpg";
                            }
                            if (! file_exists("images/car/".$nom_image)) {      // Si ne trouve toujours pas l'image
                                $nom_image = "icon.svg";
                            }
                            $nom_image = "images/car/".$nom_image;
                            echo "<img alt='".$database[0]['description']."' src='$nom_image'
                                  style='height=150px'>";
                            echo "<h3>".$database[0]['price']." &#8364;</h3>";
                            echo "<h4>Numéro d'immatriculation : ".$database[0]['numberplate']."fr<br>";
                            if ($database[0]['horsepower'] > 0) {
                                echo "Puissance : ".$database[0]['horsepower']." ch<br>";
                            }
                            if ($database[0]['color'] != "") {
                                echo "Couleur : ".$database[0]['color']."<br>";
                            }
                            echo "Age : ".$database[0]['age']." ans<br>";
                            echo "Arrivé au garage : ".$database[0]['inscription_date']."</h4>";
                            echo "<p>".$database[0]['description']."</p>";
                            echo "<form><input type='submit' value='Retirer du panier'></input></form>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Vous n'avez aucun produit dans votre panier pour le moment.<br>
                        Accèdez à notre panoplie de modèle <strong><a href='index.php'>ici</a></strong> !</p>";
                    } ?>
                </div>
            </div>
            <br>
        <?php } ?>

        <?php if (isset($_SESSION['comments'])) {   // Si user a fait des commentaires ?>
            <div class="formulaire" style="color: rgb(22, 22, 22); width: 80%;" id="comments">
                <h1>
                    Vos commentaires :
                </h1>
                <br>

                <div class="all_comments">
                <?php
                    $results = Database("comment", "*", "1");
                    $com = $results[0];
                    sort($com);                                                 // Tri tableau

                    if (count($com) > 0) {                                      // Si au moins un élément
                        foreach ($com as $key => $value) {
                            $resultat = Database("user", "username", "id='".$value."'");// Cherche par id
                            $user = $resultat[0];
                            echo "<div class='comment'>";
                            echo "<h3>".$user[0]['username']."</h3>";
                            echo "<h5>".$com[0]['writing_date']."</h5>";
                            echo "<h4>Message :</h4>";
                            echo "<p>".$com[0]['content']."</p>";
                            echo "</div><br>";
                        }
                    } else {
                        echo "<p>Vous n'avez fait aucun commentaire pour le moment.<br>
                        Accèdez à votre commentaire <strong><a href='index.php#".$com[0]['car_id']."'>ici</a></strong> !</p>";
                    } ?>
                </div>
            </div>
            <br>
        <?php } ?>

        <?php if ($is_admin and isset($_SESSION['rights'])) { ?>
            <div style="margin-right: 6%;">
                <button><a href="admin.php#car">Modifier les voitures</a></button>
                <button><a href="admin.php#brand">Modifier les marques</a></button>  <!-- ! Ajouter form pour garage.brand -->
            </div>
            <br>
        <?php } ?>

        <?php require_once "include/footer.php" ?>
    </body>
</html>