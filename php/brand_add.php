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
        <span>Ajouter une marque</span>
    </h1>
    <br>

    <?php
        if (isset($_POST['add_brand']) AND $_POST['add_brand'] == "Ajouter") {
            echo "<strong>Formulaire envoyé !<br><p style='color:red;'>";
            if (!isset($_POST['brand'])) {
                echo "Veuillez donner une marque !";
            } else if (!isset($_POST['model'])) {
                echo "Veuillez donner au moins un modèle de voiture de cette marque !";
            } else {
                BrandPart("add", array($_POST['brand'], $_POST['model']));
            }
            echo "</strong></p>";
        }
    ?>

    <div class="search_bar">
        <form action="" method="post">
            <label>
                Marque :
                <input type="varchar" name="brand" placeholder="Marque" pattern="[a-zA-Z0-9_-]{1, 255}" required>
                <br><br>
                Modèles :
                <input type="varchar" name="model" placeholder="Modèle1 Modèle2" pattern="[a-zA-Z0-9_- ]{1, 2000}" required>
                <br><br>
            </label>

            <input type="submit" name="add_brand" value="Ajouter">
        </form>
    </div>
</div>
