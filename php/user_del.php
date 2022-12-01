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
        <span>Supprimer un utilisateur</span>
    </h1>
    <br>

    <?php
        if (isset($_POST['delete_user']) AND $_POST['delete_user'] == "Supprimer") {
            echo "<strong>Formulaire envoyé !<br><p style='color:red;'>";
            UserPart("delete", "0", "username='".$_POST['username']."'");
            echo "</strong></p>";
        }
    ?>

    <div class="search_bar">
        <form action="" method="post">
            <label>
                Speudonyme :
                <select type="varchar" name="username" pattern="{3, 255}" required>
                    <?php
                        $usernames = get_database_options("user", "username");
                        foreach ($usernames as $key => $username) {
                            echo "<option value='$username' >$username</option>";
                        } ?>
                </select>
                <br><br>
            </label>

            <input type="submit" name="delete_user" value="Supprimer">
        </form>
    </div>
</div>
