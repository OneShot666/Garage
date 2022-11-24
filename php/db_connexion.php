<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    if (!isset($_SESSION['rights'])) {
        if (strpos($_SERVER['PHP_SELF'], '/css') or strpos($_SERVER['PHP_SELF'], '/data') or
        strpos($_SERVER['PHP_SELF'], '/images') or strpos($_SERVER['PHP_SELF'], '/include') or
        strpos($_SERVER['PHP_SELF'], '/php')) {
            header("Location: ../index.php");
        }
    }

    function Connexion(): PDO|string {
        $server = "localhost";
        $dbname = "garage";
        $user = "root";
        $password = "";

        try { return new PDO("mysql:host=$server; dbname=$dbname; charset=utf8;", $user, $password); }
        catch (Exception $e) { return "Erreur de connexion à la base de données :\n" . $e->getMessage(); }
    }

    function Database($dataname="user", $arg="*"): array {
        $connexion = Connexion();
        $requete = $connexion->prepare("SELECT $arg FROM garage.$dataname");
        try { $requete->execute(); }
        catch (Exception $e) { return array("Erreur de connexion à la table $dataname :\n$e"); }
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    $resultat = Database();
    $database = $resultat[0];

    $username = mysqli_real_escape_string($database, htmlspecialchars($_POST["username"]));
    $password = mysqli_real_escape_string($database, sha1(htmlspecialchars($_POST["password"])));

    header("location:index.php");
