<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION, $array_cars;
    if (!isset($_SESSION['rights'])) {
        if (strpos($_SERVER['PHP_SELF'], '/css') or strpos($_SERVER['PHP_SELF'], '/data') or
        strpos($_SERVER['PHP_SELF'], '/images') or strpos($_SERVER['PHP_SELF'], '/include') or
        strpos($_SERVER['PHP_SELF'], '/php')) {
            header("Location: ../index.php");
        }
    }
?>

<!DOCTYPE html>

<div class="formulaire" style="margin: 1%; text-align: left; width: 50%;">
    <h1 style="color: rgb(22, 22, 22);">
        <span>Supprimer une voiture</span>
    </h1>
    <br>

    <?php
        // Vérifie données entrées
        if (isset($_POST['delete']) AND $_POST['delete'] == "Supprimer") {
            echo "<strong>Formulaire envoyé !<br><p style='color:red;'>";
            if (isset($_POST['price']) AND $_POST['price'] < 0) {
                echo "Veuillez donner un prix positif !";
            } else if (isset($_POST['horsepower']) AND $_POST['horsepower'] < 0) {
                echo "Veuillez donner une puissance en chevaux positive !";
            } else if (isset($_POST['numberplate']) AND $_POST['numberplate'] < 0) {
                echo "Veuillez donner un numéro d'immatriculation positif !";
            } else {
                CarPart("delete", "0", "brand='".$_POST['brand']."' and model='"
                .$_POST['model']."' and numberplate='".$_POST['numberplate']."'");
            }
            echo "</strong></p>";
        }
    ?>

    <div class="search_bar">
        <form action="" method="post">
            <label>
                Marque :
                <select type="text" name="brand" placeholder="Marque" required>
                    <?php
                        foreach ($array_cars as $key => $brand) {
                            echo ($key=="Citroen") ? "<option value='$key' selected>$key</option>" :
                            "<option value='$key' >$key</option>";
                        } ?>
                </select>
                <br><br>
                Modèle :
                <select type="text" name="model" placeholder="Modèle" required>
                    <?php                                                   // ! Ajouter afficher en fonction de 'brand'
                        foreach ($array_cars as $key => $brand) {
                            foreach ($brand as $key2 => $model) {
                              echo ($model=="C4") ? "<option value='$model' selected>$model</option>" :
                              "<option value='$model' >$model</option>";
                            }
                        } ?>
                </select>
                <br><br>
                Prix (en euro) :
                <input type="int" name="price" placeholder="Prix" pattern="[0-9]{3,8}" required>
                &#8364;
                <br><br>
                Couleur :
                <input type="varchar" name="color" placeholder="Couleur" pattern="[a-zA-Z]" required>
                <br><br>
                Numéro d'immatriculation : fr
                <input type="int" name="numberplate" placeholder="ex : 1234"
                 pattern="[0-9]{4}" required>
                <br><br>
            </label>

            <input type="submit" name="delete" value="Supprimer">
        </form>
    </div>
</div>
