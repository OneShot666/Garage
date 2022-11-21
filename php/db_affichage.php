<?php
    if (!$_SESSION['username']) { header("Location: ../index.php"); }
    $connexion = include("db_connexion.php").connexion();
    $resultat = Affichage($connexion);

    function Affichage($connexion): array {
        $requete = $connexion -> prepare("SELECT * FROM garage.voiture");
        $requete -> execute();
        return array($requete -> fetchAll(PDO::FETCH_ASSOC));
    }

    // header("location:products.php");
