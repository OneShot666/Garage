<?php
    global $nom_du_site, $is_connected;
    $nom_du_site = "Express Car";
    $is_connected = False;

    function Connexion(): PDO|string
    {
        $server = "localhost";
        $user = "root";
        $password = "";
        $dbname = "garage";

        try {
            return new PDO("mysql:host=$server; dbname=$dbname", $user, $password);
        } catch (Exception $e) {
            return "Erreur de connexion à la base de données :\n$e";
        }
    }

    function Database($dataname="car"): array {
        $connexion = Connexion();
        $requete = $connexion->prepare("SELECT * FROM garage.$dataname");
        try {
            $requete->execute();
        } catch (Exception $e) {
            return array("Erreur de connexion à la table $dataname :\n$e");
        }
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    function Add_id_column($dataname): string {
        $connexion = Connexion();
        if ($connexion->prepare("COL_LENGTH('garage', 'id') IS NOT NULL")) {    /* Si id existe */
            $supp = $connexion->prepare("ALTER TABLE garage.$dataname DROP COLUMN id;");  /* La supprime */
            try {
                $supp->execute();
            } catch (Exception) {
                return '<script type="text/javascript">
                            alert("Échec :\n" +
                                  "Un problème est survenu lors de la suppression de la colonne id déjà existante !\n" +
                                  "Vérifier que la colonne id ne contienne pas de contraintes.")
                        </script>';
            }
        }

        $requete = $connexion->prepare("ALTER TABLE garage.$dataname ADD id INT PRIMARY KEY NOT NULL AUTO_INCREMENT FIRST;");
        try {                                                                   /* Essaie d'ajouter id */
            $requete->execute();
            return '<script type="text/javascript">
                        alert("Succès :\n" +
                              "Ajout d\'une colonne id automatique dans la table '.$dataname.' réussi.")
                    </script>';
        } catch (Exception) {
            return '<script type="text/javascript">
                        alert("Échec :\n" +
                              "Un problème est survenu lors de l\'insertion d\'une colonne id automatique !")
                    </script>';
        }
    }

    function Check_doublons($dataname): array {
        $connexion = Connexion();
        $requete = $connexion->prepare("SELECT * FROM garage.$dataname");
        $requete->execute();
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    function Delete_doublons($dataname): array {
        $connexion = Connexion();
        $requete = $connexion->prepare("SELECT * FROM garage.$dataname;");
        $requete->execute();
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    function Test($dataname): array {
        $connexion = Connexion();
        $requete = $connexion->prepare("SELECT * FROM garage.$dataname WHERE 1");
        // WHERE TABLE_NAME = 'garage.$dataname';");
        $requete->execute();
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    function Inverse_bool($var): bool {
        return ! $var;
    }
