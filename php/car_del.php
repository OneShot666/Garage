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
        if (isset($_POST['delete_car']) AND $_POST['delete_car'] == "Supprimer") {
            echo "<strong>Formulaire envoyé !<br><p style='color:red;'>";
            if (isset($_POST['numberplate']) AND $_POST['numberplate'] < 0) {
                echo "Veuillez donner un numéro d'immatriculation correct !";
            } else {
                CarPart("delete", "0", "brand='".$_POST['brand']."' and model='".
                $_POST['model']."' and color='".$_POST['color']."' and numberplate='".
                $_POST['numberplate']."'");
            }
            echo "</strong></p>";
        }
    ?>

    <div>
        <form action="" method="post">
            <label>
                Marque :
                <select type="text" name="brand" placeholder="Marque" required>
                    <?php
                        $brands = get_database_options("car", "brand");
                        foreach ($brands as $key => $brand) {
                            echo ($brand=="Citroen") ? "<option value='$brand'
                                selected>$brand</option>" : "<option value='$brand' >$brand</option>";
                        } ?>
                </select>
                <br><br>
                Modèle :
                <select type="text" name="model" placeholder="Modèle">
                    <?php                                                       // ! Ajouter afficher en fonction de 'brand' (js)
                        $models = get_database_options("car", "model");
                        foreach ($models as $key => $model) {
                            echo ($model=="C4") ? "<option value='$model'
                                selected>$model</option>" : "<option value='$model' >$model</option>";
                        } ?>
                </select>
                <br><br>
                Couleur :
                <select type="varchar" name="color">
                    <?php
                        $colors = get_database_options("car", "color");
                        foreach ($colors as $key => $color) {
                            echo "<option value='$color' >$color</option>";
                        } ?>
                </select>
                <br><br>
                Numéro d'immatriculation :
                <select type="int" name="numberplate" required>
                    <?php
                        $numberplates = get_database_options("car", "numberplate");
                        foreach ($numberplates as $key => $numberplate) {
                            echo "<option value='$numberplate' >$numberplate</option>";
                        } ?>
                </select>
                fr
                <br><br>
            </label>

            <input type="submit" name="delete_car" value="Supprimer">
        </form>
    </div>
</div>
