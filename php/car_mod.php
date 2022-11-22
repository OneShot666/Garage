<?php
    // if (!$_SESSION['username']) { header("Location: ../index.php"); }
    global $nom_du_site, $is_connected, $is_admin, $_SESSION, $array_cars;
?>

<!DOCTYPE html>

<div class="formulaire" style="margin: 1%; text-align: left; width: 50%;">
    <h1 style="color: rgb(22, 22, 22);">
        <span>Modifier une voiture</span>
    </h1>
    <br>

    <?php
        // Vérifie données entrées
        if (isset($_POST['modify']) AND $_POST['modify'] == "Modifier") {
            echo "<strong>Formulaire envoyé !<br><p style='color:red;'>";
            if (isset($_POST['price']) AND $_POST['price'] < 0) {
                echo "Veuillez donner un prix positif !";
            } else if (isset($_POST['horsepower']) AND $_POST['horsepower'] < 0) {
                echo "Veuillez donner une puissance en chevaux positive !";
            } else if (isset($_POST['numberplate']) AND $_POST['numberplate'] < 0) {
                echo "Veuillez donner un numéro d'immatriculation positif !";
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
                <select type="varchar" name="brand" placeholder="Marque" required>
                    <?php
                        foreach ($array_cars as $key => $brand) {
                            echo ($key=="Citroen") ? "<option value='$key' selected>$key</option>" :
                            "<option value='$key' >$key</option>";
                        } ?>
                </select>
                <br><br>
                Modèle :
                <select type="varchar" name="model" placeholder="Modèle" required>
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
                <input type="int" name="price" placeholder="Prix" required>
                &#8364;
                <br><br>
                Couleur :
                <input type="varchar" name="color" placeholder="couleur">
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
                Numéro d'immatriculation : fr
                <input type="int" name="numberplate" placeholder="Numéro d'immatriculation" required>
                <br><br>
                Age (en année) :
                <select type="int" name="age" required>
                    <?php
                        for ($i=1; $i <= 100; $i++) {
                            echo "<option value='$i' >$i</option>";
                        } ?>
                </select>
                ans
                <!--Date de mise en circulation :                               // Remplace age
                <input type="date" name="age" placeholder="Date de mise en circulation" required-->
                <br><br>
                Date d'arrivée dans notre garage :
                <input type="date" name="inscription_date" value="<?php echo date('Y-m-d'); ?>"
                       placeholder="Date d'entrée au garage">
                <br><br>
                Description :
                <input type="varchar" name="description" placeholder="Description de la voiture">
                <br><br>
            </label>

            <input type="submit" name="modify" value="Modifier">
        </form>
    </div>
</div>
