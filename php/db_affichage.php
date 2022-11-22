<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    // if (!$_SESSION['username']) { header("Location: ../index.php"); }
    $connexion = include("db_connexion.php").connexion();
    $resultat = Affichage($connexion);

    function Affichage($connexion): array {
        $requete = $connexion -> prepare("SELECT * FROM garage.car");
        $requete -> execute();
        return array($requete -> fetchAll(PDO::FETCH_ASSOC));
    }

    // header("location:products.php");
