<?php
    if (!$_SESSION['username']) { header("Location: ../index.php"); }
    include("php/function.php");
    global $nom_du_site;
    $page_name = $nom_du_site . " - Changer de voiture";
    $nav = "change_car";
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>                                                                      <!-- Voir utilite de cette page -->
        <div class="search_bar">
            <form action="" method="get">
                <label>
                    Entrer une marque :
                    <br>
                    <input type="text" name="brand" placeholder="Marque">
                    <br><br>
                    Entrer un modèle :
                    <br>
                    <input type="text" name="model" placeholder="Modèle">
                    <br><br>
                    Entrer un prix :
                    <br>
                    <input type="text" name="price" placeholder="Prix">
                    <br><br>
                    Entrer une puissance (en chevaux) :
                    <br>
                    <input type="text" name="horsepower" placeholder="Nombre de chevaux">
                    <br><br>
                    Entrer un numéro d'immatriculation :
                    <br>
                    <input type="text" name="numberplate" placeholder="Numéro d'immatriculation">
                    <br><br>
                    Entrer une date de mise en circulation :
                    <br>
                    <input type="date" name="age" placeholder="Date de mise en circulation">
                    <br><br>
                    Entrer la date d'arrivée dans notre garage :
                    <br>
                    <input type="date" name="inscription_date" placeholder="Date d'entrée au garage">
                    <br><br>
                </label>

                <input type="submit" name="envoyer" value="Envoyer">
            </form>
        </div>
    </body>
</html>
