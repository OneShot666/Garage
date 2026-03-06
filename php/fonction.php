<?php
    global $nom_du_site;
    $nom_du_site = "Express Car";

    function Connexion() {
        $server = "localhost";
        $user = "root";
        $password = "";
        $dbname = "garage";

        try {
            return new PDO("mysql:host=$server; dbname=$dbname", $user, $password);
        } catch (Exception $e) {
            return "Erreur de connexion à la base de données : $e";
        }
    }

    function Database($dataname="voiture"): array {
        $connexion = Connexion();
        try {
            $requete = $connexion->prepare("SELECT * FROM garage.$dataname");
        } catch (Exception $e) {
            $requete = $connexion->prepare("SELECT * FROM garage.voiture");
        }
        $requete->execute();
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    function Nav_item(string $lien, string $titre, string $style = ""): string {
        $classe = 'nav-item';
        if ($_SERVER["SCRIPT_NAME"] === $lien) {
            $classe .= ' active';
        }
        return '<li class="'.$classe.'" style="'.$style.'"><a class="nav-link" href="'.$lien.'">'.$titre.'</a></li>';
    }

    function Inverse_var($tab): bool {
        return ! $tab;
    }
