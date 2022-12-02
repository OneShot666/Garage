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
        <span>Modifier une marque</span>
    </h1>
    <br>

    <?php
        if (isset($_POST['modify_brand']) AND $_POST['modify_brand'] == "Modifier") {
            echo "<strong>Formulaire envoyé !<br><p style='color:red;'>";
            if (!isset($_POST['brand'])) {
                echo "Veuillez donner une marque à modifier !";
            } else if (!isset($_POST['model'])) {
                echo "Veuillez donner au moins un nouveau modèle de voiture pour cette marque !";
            } else {
                BrandPart("modify", array($_POST['brand'], $_POST['model'], $_POST['active']));
            }
            echo "</strong></p>";
        }
    ?>

    <div class="search_bar">
        <form action="" method="post">
            <label>
                Marque :
                <select type="varchar" name="brand" placeholder="Marque" pattern="{1, 255}" required>
                    <?php
                        $brands = get_database_options("brand", "brand");
                        foreach ($brands as $key => $brand) {
                            echo "<option value='$brand' >$brand</option>";
                        } ?>
                </select>
                <br><br>
                Modèles :
                <select type="varchar" name="model" placeholder="Modèles" pattern="{1, 2000}" required>
                    <?php
                        $models_list = get_database_options("brand", "model");
                        $models = array();
                        foreach ($models_list as $key => $list) {               // Get string en array
                            $tab = explode(" ", $list);
                            foreach ($tab as $key => $value) {
                                array_push($models, $value);
                            }
                        }
                        sort($models);
                        foreach ($models as $key => $model) {
                            echo "<option value='$model' >$model</option>";
                        } ?>
                </select>
                <br><br>
                Marque active ?
                <select type="tinyint" name="active">
                    <option value="0">0</option>
                    <option value="1" selected>1</option>
                </select>
                <br><br>
            </label>

            <input type="submit" name="modify_brand" value="Modifier">
        </form>
    </div>
</div>
