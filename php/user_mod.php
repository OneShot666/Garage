<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION, $array_cars, $patterns;
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
                $_POST['inscription_date'], $_POST['favoris'], $_POST['panier'], $_POST['comments'],
                $_POST['banned']), "username='".$_POST['username']."'");
            }
            echo "</strong></p>";
        }
    ?>

    <div>
        <form action="" method="post">
            <label>
                Nom :
                <input type="varchar" name="name" placeholder="Nom"
                    pattern="<?= $patterns['name']; ?>" required>
                <br><br>
                Prénom :
                <input type="varchar" name="nickname" placeholder="Prénom"
                    pattern="<?= $patterns['nickname']; ?>" required>
                <br><br>
                Age :
                <select type="int" name="age" pattern="<?= $patterns['age']; ?>" required>
                    <?php
                        for ($i=18; $i <= 100; $i++) {
                            echo "<option value='$i' >$i</option>";
                        } ?>
                </select>
                ans
                <br><br>
                Téléphone : +687
                <input type="tel" name="phone" placeholder="Numéro de téléphone"
                    pattern="<?= $patterns['phone']; ?>">
                <br><br>
                Adresse mail
                <input type="mail" name="mail" placeholder="adresse@gmail.com"
                    pattern="<?= $patterns['mail']; ?>">
                <br><br>
                Pseudonyme :
                <select type="varchar" name="username" required>
                    <?php
                        $usernames = get_database_options("user", "username");
                        foreach ($usernames as $key => $username) {
                            echo "<option value='$username' >$username</option>";
                        } ?>
                </select>
                <br><br>
                Mot de passe :
                <input type="varchar" name="password" placeholder="Mot de passe"
                    pattern="<?= $patterns['password']; ?>" required>
                <br><br>
                Date d'inscrition au site :
                <input type="date" name="inscription_date" value="<?php echo date('Y-m-d'); ?>">
                <br><br>
                Ses favoris :
                <input type="varchar" name="favoris" placeholder="Index des produits seulement"
                    pattern="<?= $patterns['favoris']; ?>">
                <br><br>
                Son panier :
                <input type="varchar" name="panier" placeholder="Index des produits seulement"
                    pattern="<?= $patterns['panier']; ?>">
                <br><br>
                Ses commentaires : <br>
                <textarea name="comments" placeholder="Super site !"></textarea>
                <br><br>
                Banni(e) ?
                <select type="tinyint" name="banned">
                    <option value="0" selected>0</option>
                    <option value="1">1</option>
                </select>
                <br><br>
            </label>

            <input type="submit" name="modify_user" value="Modifier">
        </form>
    </div>
</div>
