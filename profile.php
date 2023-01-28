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
            <?php echo $page_name; ?>
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

        <div class="formulaire" style="color: rgb(22, 22, 22); width: 80%;">
            <h1>
                Votre profil :
            </h1>
            <br>

            <h3>
                <?php if ($is_admin) {                      //Si admin ?>
                    Pseudo : <?php echo $_SESSION['username']; ?>
                    <br><br>
                    Droits : <?php echo $_SESSION['rights']; ?>
                    <br><br>
                <?php } else {                              // Si user ?>
                    Nom : <?php echo $_SESSION['name']; ?>
                    <br><br>
                    Prénom : <?php echo $_SESSION['nickname']; ?>
                    <br><br>
                    Pseudo : <?php echo $_SESSION['username']; ?>
                    <br><br>
                    Age : <?php echo $_SESSION['age']; ?> ans
                    <br><br>
                    Téléphone : +687 <?php echo $_SESSION['phone']; ?>
                    <br><br>
                    Email : <?php echo $_SESSION['mail']; ?>
                    <br><br>
                <?php } ?>
            </h3>
        </div>

        <br>

        <?php if (isset($_SESSION['favoris'])) {            // Si user a favoris ?>
            <div class="formulaire" style="color: rgb(22, 22, 22); width: 80%;">
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
                      $fav = explode(" ", $fav[0]['favoris']);                  // Transforme nbs en tableau
                      sort($fav);                                               // Tri tableau

                      if (count($fav) > 0) {                                    // Faire par id
                          foreach ($fav as $key => $value) {
                              $resultat = CarPart("select", "*", "id='".$value."'");
                              $database = $resultat[0];
                              echo "<div class='product'>";
                              echo "<h3>".$database[0]['brand']." ".$database[0]['model']."</h3>";
                              $nom_image = "car-".strtolower($database[0]['brand'])."-".
                                             strtolower($database[0]['model']).
                                             "-fr ".strtolower($database[0]["numberplate"]).".jpg";
                              if (! file_exists("images/car/".$nom_image)) {    // Si ne trouve pas l'image
                                  $nom_image = "car-".strtolower($database[0]['brand'])."-".
                                               strtolower($database[0]['model']).
                                               "-fr 0000.jpg";
                              }
                              if (! file_exists("images/car/".$nom_image)) {    // Si ne trouve toujours pas l'image
                                  $nom_image = "icon.svg' style='height=150px";
                              }
                              $nom_image = "images/car/".$nom_image;
                              echo "<img alt='".$database[0]['description']."' src='$nom_image'>";
                              echo "<h4>Numéro d'immatriculation : ".$database[0]['numberplate']."fr</h4>";
                              echo "<h4>Puissance : ".$database[0]['horsepower']." ch</h4>";
                              echo "<h4>Couleur : ".$database[0]['color']."</h4>";
                              echo "<h4>Age : ".$database[0]['age']." ans</h4>";
                              echo "<h4>Arrivé au garage : ".$database[0]['inscription_date']."</h4>";
                              echo "<h3>".$database[0]['price']." &#8364;</h3>";
                              echo "<p>".$database[0]['description']."</p>";
                              echo "</div>";
                          }
                      } else {
                          echo "Vous n'avez aucun favoris pour le moment.<br>
                          Accèdez à notre panoplie de modèle <a href='index.php'>ici</a> !";
                      } ?>
                </div>
            </div>
        <?php } else { ?>
            <div>
                <!-- ! Mettre bouton pour accèder aux différents formulaires back-end (car) + pour garage.brand -->
            </div>
        <?php } ?>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
