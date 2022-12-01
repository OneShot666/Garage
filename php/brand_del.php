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
        <span>Supprimer une marque</span>
    </h1>
    <br>

    <?php
        if (isset($_POST['delete_brand']) AND $_POST['delete_brand'] == "Supprimer") {
            echo "<strong>Formulaire envoyé !<br><p style='color:red;'>";
            if (isset($_POST['brand'])) { echo "Veuillez donner une marque à supprimer !"; }
            else { BrandPart("delete", "0", "brand='".$_POST['brand']."'"); }
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
            </label>

            <input type="submit" name="delete_brand" value="Supprimer">
        </form>
    </div>
</div>
