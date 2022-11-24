<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    if (!isset($_SESSION['rights'])) {
        if (strpos($_SERVER['PHP_SELF'], '/css') or strpos($_SERVER['PHP_SELF'], '/data') or
        strpos($_SERVER['PHP_SELF'], '/images') or strpos($_SERVER['PHP_SELF'], '/include') or
        strpos($_SERVER['PHP_SELF'], '/php')) {
            header("Location: ../index.php");
        }
    }
?>

<form action="db_connexion.php">
    <input type="varchar" name="username" value="username" placeholder="Pseudonyme"></input>
    <input type="varchar" name="password" value="password" placeholder="Mot de passe"></input>
    <input type="submit" name="envoyer" value="Envoyer"></input>
</form>
