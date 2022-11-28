<?php
    session_start();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION, $array_cars;
    $nom_du_site = "Express Car";
    $is_connected = (isset($_SESSION['username'])) ? True : False;
    $is_admin = (isset($_SESSION['username']) and isset($_SESSION['rights'])) ? True : False;
    $array_cars = [
      "Alfa"=>[],
      "Audi"=>[],
      "Bmw"=>[],
      "Citroen"=>["Berlingo", "C3", "C4", "C5"],
      "Dacia"=>[],
      "Fiat"=>[],
      "Ford"=>[],
      "Mercedes"=>[],
      "Nissan"=>[],
      "Opel"=>[],
      "Peugeot"=>["108", "208", "308", "408", "508"],
      "Renault"=>["Captur", "Clio", "Espace", "Kangoo", "Twingo"],
      "Romeo"=>[],
      "Seat"=>[],
      "Suzuki"=>["Across", "Ignis", "Swift", "Vitara"],
      "Tesla"=>[],
      "Toyota"=>[],
      "Volkswagen"=>[],
    ];
    header("refresh: 60");                                                      // Rafraîchis le site toutes les minutes

    function Redirection($right="a") {                                          // Renvoie user si modifie url
        global $is_admin, $_SESSION;
        $right = ($right == "-") ? "r" : $right;                                // Empêche les magouilles
        if (!($is_admin and isset($_SESSION['rights']) and
        isset($_SESSION['has_rights']) and $_SESSION['has_rights'])) {
            if (strpos($_SERVER['PHP_SELF'], '/css') or strpos($_SERVER['PHP_SELF'], '/data') or
            strpos($_SERVER['PHP_SELF'], '/images') or strpos($_SERVER['PHP_SELF'], '/include') or
            strpos($_SERVER['PHP_SELF'], '/php')) {
                if (!strpos($_SERVER['PHP_SELF'], 'error.php')) {
                    try { header("Location: error.php"); }
                    catch (Exception) { header("Location: ../error.php"); }
                }
            }
            if (!(strpos($_SESSION['rights'], "a") or strpos($_SESSION['rights'], $right))) {    // Si pas les droits
                if (!strpos($_SERVER['PHP_SELF'], 'error.php')) {
                    try { header("Location: error.php"); }
                    catch (Exception) { header("Location: ../error.php"); }
                }
            }
        }
    }

    function Connexion(): PDO|string {
        $server = "localhost";
        $dbname = "garage";
        $user = "root";
        $password = "";
        // $port = 80;
        // $command = \PDO::MYSQL_ATTR_INIT_COMMAND;                               // 1002;

        try { return new PDO("mysql:host=$server; dbname=$dbname; charset=utf8;", $user, $password); }
        catch (Exception $e) { return "Erreur de connexion à la base de données :\n" . $e->getMessage(); }
        // try { return new PDO("mysql:host=".$server."; dbname=".$dbname."; port=".$port,
        //      $user, $password, array(\PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES 'utf8'", 65536)); }
        //catch (Exception $e) { return "Erreur de connexion à la base de données :\n" . $e->getMessage(); }
    }

    function ExecuteSqlFile() {
        $req = file_get_contents("data/garage.sql");
        Sql($req);                                                              // Execute fichier entier
    }

    function Database($dataname='car', $column='*', $condition='1'): array {
        $connexion = Connexion();
        $requete = $connexion->prepare("SELECT $column FROM garage.$dataname WHERE $condition");
        try { $requete->execute(); }
        catch (Exception $e) { return array("Erreur de connexion à la table '$dataname' :\n$e"); }
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    // ! Si 'add', vérifier que la voiture n'existe pas déjà
    // ! Si 'delete', vérifier que l'on ne supprime qu'une voiture
    function CarPart($request="", $column="*", $condition="1") {
        $connexion = Connexion();
        $column = ($request=="delete" AND $column=="*") ? "description" : $column;// Evite de tous supprimer
        $condition = ($column=="*" AND $condition=="1" AND $condition!="select") ?
                     "0" : $condition;                                          // Evite de tous modifier
        if ($request =="add") {                                                 // Ajoute une voiture
            $sql="INSERT INTO garage.car(brand, model, numberplate, inscription_date,
            age, color, horsepower, price, description) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $requete = $connexion->prepare($sql);
            $requete->execute($column);
        } else if ($request =="modify") {                                       // Modifie une voiture
            $sql="UPDATE garage.car SET brand=?, model=?, numberplate=?, inscription_date=?,
            age=?, color=?, horsepower=?, price=?, description=? WHERE $condition";
            $requete = $connexion->prepare($sql);
            $requete->execute($column);
        } else if ($request =="delete") {                                       // Supprime une voiture
            $sql="DELETE FROM garage.car WHERE $condition";
            $requete = $connexion->prepare($sql);
            $requete->execute();
        } else {                                                                // Retourne une voiture
            $sql="SELECT $column FROM garage.car WHERE $condition";
            $requete = $connexion->prepare($sql);
            $requete->execute();
            return array($requete->fetchAll(PDO::FETCH_ASSOC));
        }
    }

    function Add_id_column($dataname): string {
        $connexion = Connexion();
        if ($connexion->prepare("COL_LENGTH('garage', 'id') IS NOT NULL")) {    /* Si id existe */
            $supp = $connexion->prepare("ALTER TABLE garage.$dataname DROP COLUMN id;");  /* La supprime */
            try { $supp->execute(); }
            catch (Exception) {                                                 // js ?
                return '<script type="text/javascript">
                            alert("Échec :\n" + "Un problème est survenu lors de
                            la suppression de la colonne id déjà existante !\n" +
                            "Vérifier que la colonne id ne contienne pas de contraintes.")
                        </script>';
            }
        }

        $requete = $connexion->prepare("ALTER TABLE garage.$dataname
                   ADD id INT PRIMARY KEY NOT NULL AUTO_INCREMENT FIRST;");
        try {                                                                   /* Essaie d'ajouter id */
            $requete->execute();
            return '<script type="text/javascript">
                        alert("Succès :\n" +
                              "Ajout d\'une colonne id automatique dans la table '
                               .$dataname.' réussi.")
                    </script>';
        } catch (Exception) {
            return '<script type="text/javascript">
                        alert("Échec :\n" +
                              "Un problème est survenu lors de l\'insertion
                               d\'une colonne id automatique !")
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
        $requete = $connexion->prepare("SELECT * FROM garage.$dataname;");      /* Manque le DROP */
        $requete->execute();
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    function Test($dataname): array {
        $connexion = Connexion();
        $requete = $connexion->prepare("SELECT * FROM $dataname WHERE 1");
        $requete->execute();
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    function get_form_phone($phone) {
        $form = str_split($phone, 2);
        return (count($form) <= 3) ? $form[0].".".$form[1].".".$form[2] : $phone;
    }

    function is_letter_in_word($word, $letter): bool {                          // Used in profile
        $index = strpos($word, $letter);
        return ((gettype($index) == "integer" and $index >= 0) or
                ($index === 0 or $index === 1));                                // Si return un entier positif ou un booléen vrai
    }

    // ! Déplacé dans header.php
    /* function Nav_item(string $lien, string $titre, string $style = ""): string {
        $classe = 'nav-item';
        if ($_SERVER["SCRIPT_NAME"] === $lien) {
            $classe .= ' active';
        }
        return '<li class="'.$classe.'" style="'.$style.'"><a class="nav-link"
                href="'.$lien.'">'.$titre.'</a></li>';
    } */

    function Inverse_bool($var): bool {
        return ! $var;
    }
