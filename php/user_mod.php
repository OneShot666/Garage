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
        <span>Modifier un utilisateur</span>
    </h1>
    <br>

    <?php
        if (isset($_POST['modify_user']) AND $_POST['modify_user'] == "Modifier") {
            echo "<strong>Formulaire envoyé !<br><p style='color:red;'>";
            if (isset($_POST['age']) AND $_POST['age'] < 18) {
                echo "L'utilisateur doit être majeur !";
            } else {
                UserPart("modify", array($_POST['name'], $_POST['nickname'], $_POST['age'],
                $_POST['phone'], $_POST['mail'], $_POST['username'], $_POST['password'],
                $_POST['inscription_date'], $_POST['favoris'], $_POST['panier'], $_POST['comments']),
                "username=".$_POST['username']." and password=".$_POST['password']);
            }
            echo "</strong></p>";
        }
    ?>

    <div class="search_bar">
        <form action="" method="post">
            <label>
                Nom :
                <input type="varchar" name="name" placeholder="Nom" pattern="[a-zA-Z]{3, 255}" required>
                <br><br>
                Prénom :
                <input type="varchar" name="nickname" placeholder="Prénom" pattern="[a-zA-Z]{3, 255}" required>
                <br><br>
                Age :
                <select type="int" name="age" pattern="[0-9]{2, 12}" required>
                    <?php
                        for ($i=18; $i <= 100; $i++) {
                            echo "<option value='$i' >$i</option>";
                        } ?>
                </select>
                <br><br>
                Téléphone : +687
                <input type="tel" name="phone" placeholder="Numéro de téléphone" pattern="[0-9]{6}">
                <br><br>
                Adresse mail
                <input type="mail" name="mail" placeholder="adresse@gmail.com" pattern="[a-zA-Z0-9_-]@gmail.com">
                <br><br>
                Speudonyme :
                <select type="varchar" name="username" pattern="{3, 255}" required>
                    <?php
                        $usernames = get_database_options("user", "username");
                        foreach ($usernames as $key => $username) {
                            echo "<option value='$username' >$username</option>";
                        } ?>
                </select>
                <br><br>
                Mot de passe :
                <input type="varchar" name="password" placeholder="Mot de passe" pattern="{3, 999}" required>
                <br><br>
                Date d'inscrition au site :
                <input type="date" name="inscription_date" value="<?php echo date('Y-m-d'); ?>">
                <br><br>
                Ses favoris :
                <input type="varchar" name="favoris" placeholder="Index des produits seulement">
                <br><br>
                Son panier :
                <input type="varchar" name="panier" placeholder="Index des produits seulement">
                <br><br>
                Ses commentaires :
                <input type="text" name="comments" placeholder="Super site !">
                <br><br>
            </label>

            <input type="submit" name="modify_user" value="Modifier">
        </form>
    </div>
</div>
