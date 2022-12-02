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
        <span>Modifier une voiture</span>
    </h1>
    <br>

    <?php
        if (isset($_POST['modify_car']) AND $_POST['modify_car'] == "Modifier") {
            echo "<strong>Formulaire envoyé !<br><p style='color:red;'>";
            if (isset($_POST['price']) AND $_POST['price'] < 0) {
                echo "Veuillez donner un prix positif !";
            } else if (isset($_POST['horsepower']) AND $_POST['horsepower'] < 0) {
                echo "Veuillez donner une puissance en chevaux positive !";
            } else if (isset($_POST['numberplate']) AND $_POST['numberplate'] < 0) {
                echo "Veuillez donner un numéro d'immatriculation correct !";
            } else if (isset($_POST['age']) AND $_POST['age'] < 0) {
                echo "Veuillez donner un age positif !";
            } else {
                CarPart("modify", array($_POST['brand'], $_POST['model'],
                $_POST['numberplate'], $_POST['inscription_date'], $_POST['age'],
                $_POST['color'], $_POST['horsepower'], $_POST['price'], $_POST['description']),
                "brand='".$_POST['brand']."' and model='".$_POST['model'].
                "' and numberplate='".$_POST['numberplate']."'");
            }
            echo "</strong></p>";
        }
    ?>

    <div class="search_bar">
        <form action="" method="post">
            <label>
                Marque :
                <select type="varchar" name="brand" required>
                    <?php
                    foreach ($array_cars as $key => $brand) {
                        echo ($key=="Citroen") ? "<option value='$key' selected>$key</option>" :
                        "<option value='$key' >$key</option>";
                    } ?>
            </select>
            <br><br>
            Modèle :
            <select type="text" name="model" required>
                <?php
                    $models = get_dictionnary_options($array_cars);
                    foreach ($models as $key => $model) {
                        echo ($model=="C4") ? "<option value='$model' selected>$model</option>" :
                        "<option value='$model' >$model</option>";
                    } ?>
                </select>
                <br><br>
                Prix (en euro) :
                <input type="int" name="price" placeholder="Prix" pattern="[0-9]{3, 8}" required>
                &#8364;
                <br><br>
                Couleur :
                <input type="varchar" name="color" placeholder="Couleur" pattern="[a-zA-Z]">
                <br><br>
                Chevaux moteur :
                <select type="int" name="horsepower" required>
                    <?php
                        for ($i=10; $i <= 2000; $i+=10) {
                            echo "<option value='$i' >$i</option>";
                        } ?>
                </select>
                ch
                <br><br>
                Numéro d'immatriculation :
                <select type="int" name="numberplate" pattern="[0-9]{4}" required>
                    <?php
                        $numberplates = get_database_options("car", "numberplate");
                        foreach ($numberplates as $key => $numberplate) {
                            echo "<option value='$numberplate' >$numberplate</option>";
                        } ?>
                </select>
                fr
                <br><br>
                Age (en année) :
                <select type="int" name="age" required>
                    <?php
                        for ($i=1; $i <= 100; $i++) {
                            echo "<option value='$i' >$i</option>";
                        } ?>
                </select>
                ans
                <br><br>
                <!--Date de mise en circulation :                               // Remplace age
                <input type="date" name="age" placeholder="Date de mise en circulation" required>
                <br><br-->
                Date d'arrivée dans notre garage :
                <input type="date" name="inscription_date" value="<?php echo date('Y-m-d'); ?>"
                    placeholder="Date d'entrée au garage">
                <br><br>
                Description :
                <input type="text" name="description" placeholder="Description de la voiture"
                    pattern="[a-zA-Z0-9_-]{20, 999}">
                <br><br>
            </label>

            <input type="submit" name="modify_car" value="Modifier">
        </form>
    </div>
</div>