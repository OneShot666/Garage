<?php
    session_start();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION, $patterns, $array_cars, $colors;
    $nom_du_site = "Express Car";
    $is_connected = (isset($_SESSION['username'])) ? True : False;
    $is_admin = (isset($_SESSION['username']) and isset($_SESSION['rights'])) ? True : False;
<<<<<<< HEAD
    // Tableau de la base de donnée (! ajouter protection ?)
    $DATABASE = array();
    $DATABASE = ["garage"=>[
        "admin"=>["id", "username", "password", "inscription_date", "has_rights",
                "rights", "actions", "comments"],
        "brand"=>["id", "brand", "model", "length", "active", "ajout_date"],
        "car"=>["id", "brand", "model", "numberplate", "inscription_date", "age",
                "color", "horsepower", "price", "description"],
        "comment"=>["id", "user_id", "car_id", "content", "writing_date"],
        "user"=>["id", "name", "nickname", "age", "phone", "mail", "username",
                "password", "inscription_date", "favoris", "panier", "comments", "banned"],
    ]];
    // Utilisé dans formulaires
    $patterns = [// User
                "name"=>"/^[A-Z][a-z]+{3,255}/",
                "nickname"=>"/^[A-Z][a-z]+{3,255}/",
                "age"=>"/[0-9]{2,12}/",
                "phone"=>"/[0-9]{6}/",
                "mail"=>"/^[a-zA-Z-_]@[a-zA-Z].[a-zA-Z]/",
                "username"=>"/^[a-zA-Z0-9-_ ]{3,255}/",
                "password"=>"/^[a-zA-Z0-9-_.,:;?!+@#'\/() ]{8,255}/",
                "inscription_date"=>"",
                "favoris"=>"/^[0-9 ]/",
                "panier"=>"/^[0-9 ]/",
                "comments"=>"/^[a-zA-Z0-9-_.,:;?!+@#'\/() ]{20,200}/",
                "banned"=>"/[0-1]{1}/",
                // Cars
                "brand"=>"/^[a-zA-Z0-9-_ ]{1,255}/",
                "model"=>"/^[a-zA-Z0-9-_ ]{1,2000}/",
                "price"=>"/^[0-9]{3,8}/",
                "color"=>"/^[a-zA-Z- ]/",
                "numberplate"=>"/^[0-9]{4}/",
                "description"=>"/^[a-zA-Z0-9-_.,:?!'\/() ]{20,999}/",
                // Contact
                "message"=>"/^[a-zA-Z0-9-_.,:;?!+@#'\/() ]{20,999}/",
    ];
=======
>>>>>>> 24f993ba1f7d6129c3500cf5c1ee4d685e0d56c3
    // ! Tableaux avec les marques et modèles de voitures (à retirer ?)
    $array_cars = ["Alfa Romeo"=>"Stelvio Tonale", "Audi"=>"A4 A5 A8 Q3 Q5 Q7",
        "BMW"=>"X1 X2 X3 X4 X5 X6 X7", "Citroen"=>"Berlingo C3 C4 C5",
        "Dacia"=>"Duster Sandero Spring Jogger", "Fiat"=>"500C 500X 500L Tipo Panda",
        "Ford"=>"Focus Fiesta Mustang Explorer Kuga Mondeo Puma Ecosport",
<<<<<<< HEAD
        "Mercedes-Benz"=>"GLC GLA GLE AMG SL",
        "Nissan"=>"X-Trail Micra Qashqai Leaf Juke Ariya Combi",
        "Opel"=>"Astra Corsa Mokka Crossland Grandland Insignia Zafira",
        "Peugeot"=>"108 208 308 408 508",
        "Renault"=>"Captur Clio Espace Kangoo Twingo", "Seat"=>"Leon Ibiza Arona Ateca Tarraco",
        "Suzuki"=>"Across Ignis Swift Vitara", "Tesla"=>"Model3 ModelY ModelX ModelS",
        "Toyota"=>"Landcruiser Yaris Corolla Prius Camry CHR SUPRA",
        "Volkswagen"=>"Golf Polo Tiguan Touran T-Roc T-Cross Caddy",
    ];
    // ! Faire "couleur"=>"color" pour fond coloré ?
    $colors = ["autre", "bordeaux", "pourpre", "rouge", "rouge orangée", "orange",
        "jaune", "poussin", "kaki", "verte claire", "verte", "verte foncée", "cyan",
        "turquoise", "bleue ciel", "bleue", "marine", "mauve", "violette", "marron",
        "saumon", "rose", "blanche", "grise claire", "grise", "grise foncée", "noire"];
    // Rafraîchis le site toutes les X minutes
    $nb_min = 5;
    header("refresh: ".$nb_min * 60);

    /* Type d'erreurs :
    1 – E_ERROR : Erreur critique entraînant une interruption du script;
    2 – E_WARNING : Message d’avertissmt (ex: échec open file) mais continue exécut°;
    4 – E_PARSE : Erreur de syntaxe dans le fichier;
    8 – E_NOTICE : Message faible imptt, exécut° pas perturbée (ex: lire var non déclarée);
    256 – E_USER_ERROR : Message d’erreur généré par user. Générée par use° de f° trigger_error();
    512 – E_USER_WARNING : //;
    1024 – E_USER_NOTICE : //;
    2048 – E_STRICT : Erreur d’avertissmt pour use° ancienne syntaxe déconseillée.
    */

    /* Arguments :
    $errno – niveau d’erreur (obligatoire);
    $errstr – message (obligatoire);
    $errfile – nom du fichier (optionnel);
    $errline – numéro de ligne (optionnel);
    $errcontext – tab avec all vars qd erreur a été déclenchée (optionnel).
    */
    function ErrorPerso($errno, $errstr, $errfile, $errline){
        echo "Erreur n°$errno, ligne n°$errline, du fichier '$errfile' :  $errstr";
    }

    function ErrorUser($errno, $errstr){
        echo "Erreur n°$errno :  $errstr";
    }

    set_error_handler('ErrorPerso');                                            // Set les erreurs système
    set_error_handler('ErrorUser', E_USER_ERROR);                               // Set celle pour 256
    set_error_handler('ErrorUser', E_USER_WARNING);                             // Set celle pour 512
    set_error_handler('ErrorUser', E_USER_NOTICE);                              // Set celle pour 1024
    // Se déclenche avec : trigger_error("Le prix ne peux pas être nul",E_USER_WARNING );

    /* Arguments :
    $script - Adresse du fichier
    $ligne - Numéro de ligne
    $message - Message
    */
    function AssertPerso($script, $ligne, $message){
        echo "Assertion fausse dans le fichier : <br> $script <br> à la ligne n°$ligne : <br>$message";
    }

    assert_options(ASSERT_ACTIVE, 1);                                           // Active éval° de f° assert()
    assert_options(ASSERT_WARNING, 0);                                          // Génère alerte pour chaque assert° fausse
    assert_options(ASSERT_CALLBACK,'AssertPerso');                              // Personnalise les erreurs assertion

    /* ---------------------------- Autres fonctions -------------------------- */
=======
        "Mercedes-Benz"=>"GLC GLA GLE AMG SL", "Peugeot"=>"108 208 308 408 508",
        "Nissan"=>"X-Trail Micra Qashqai Leaf Juke Ariya Combi",
        "Opel"=>"Astra Corsa Mokka Crossland Grandland Insignia Zafira",
        "Renault"=>"Captur Clio Espace Kangoo Twingo", "Seat"=>"Leon Ibiza Arona Ateca Tarraco",
        "Suzuki"=>"Across Ignis Swift Vitara", "Tesla"=>"Model3 ModelY ModelX ModelS",
        "Toyota"=>"Landcruiser Yaris Corolla Prius Camry CHR SUPRA",
        "Volkswagen"=>"Golf Polo Tiguan Touran T-roc T-cross Caddy",
    ];
    header("refresh: 60");                                                      // Rafraîchis le site toutes les minutes

>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
    function Redirection($right="a") {                                          // Renvoie user si modifie url
        global $is_admin, $_SESSION;
        $right = ($right == "-") ? "r" : $right;                                // Empêche les magouilles
        if (!($is_admin and isset($_SESSION['rights']) and
        isset($_SESSION['has_rights']) and $_SESSION['has_rights'])) {          // Si pas les droits
            if (strpos($_SERVER['PHP_SELF'], '/css') or strpos($_SERVER['PHP_SELF'], '/data') or
            strpos($_SERVER['PHP_SELF'], '/images') or strpos($_SERVER['PHP_SELF'], '/include') or
            strpos($_SERVER['PHP_SELF'], '/php')) {                             // Si dans fichiers interdits
                if (!strpos($_SERVER['PHP_SELF'], 'error.php')) {               // Si pas dans error.php
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
<<<<<<< HEAD
        // try { return new PDO("mysql:host=".$server."; dbname=".$dbname."; port=".$port,          // Autre type connexion
        //      $user, $password, array(\PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES 'utf8'", 65536)); }
        catch (Exception $e) { return "Erreur de connexion à la base de données :\n" . $e->getMessage(); }
=======
        catch (Exception $e) { return "Erreur de connexion à la base de données :\n" . $e->getMessage(); }
        // try { return new PDO("mysql:host=".$server."; dbname=".$dbname."; port=".$port,
        //      $user, $password, array(\PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES 'utf8'", 65536)); }
        //catch (Exception $e) { return "Erreur de connexion à la base de données :\n" . $e->getMessage(); }
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
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

    /* query() = prepare() + execute() (+/-) */
    function CarPart($request="", $column="*", $condition="1") {
        global $DATABASE;
        $connexion = Connexion();
<<<<<<< HEAD
        $condition = ($request=="delete" AND $condition=="1") ? "0" : $condition; // Evite de tous supprimer
        $condition = ($column=="*" AND $condition=="1" AND $request!="select") ?
                     "0" : $condition;                                          // Evite de tous modifier
        $error = False;
        $message = "";
        if ((in_array($column, $DATABASE['garage']['car']) and $column != 'id') or
        ($column == "*")) {                                                     // Si parametre correct
            if (gettype($column) == "array") {
                foreach ($column as $key => $value) {
                    $column[$key] = htmlspecialchars($value);                   // Empêche le code html
                    if ($key == 8) $column[$key] = nl2br($column[$key]);        // Conserve sauts de lignes (comments)
                }
            } else if (gettype($column) == "string") $column = htmlspecialchars($column);   // Empêche le code html
            if ($request =="add") {                                             // Ajoute une voiture
                $results = Database("car", "numberplate", "numberplate=".$column[2]);
                $check = $results[0];
                if (count($check) > 0) {                                        // Si existe déjà
                    $error = True;
                    $message .= "Une voiture avec le même numéro d'immatriculation (".$column[2].") existe déjà !<br>";
                    $message .= "Veuillez utiliser le formulaire de modification pour ce produit.";
                } else {
                    $sql="INSERT INTO garage.car(brand, model, numberplate, inscription_date,
                        age, color, horsepower, price, description) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $requete = $connexion->prepare($sql);
                    $requete->execute($column);
                    $message .= "Voiture ajoutée avec succès !";
                }
            } else if ($request =="modify") {                                   // Modifie une voiture
                $results = CarPart("select", "numberplate", $condition);
                $check = $results[0];
                if (count($check) > 1) {                                        // Si plus d'une voiture
                    $error = True;
                    $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'un produit.";
                } else {
                    $sql="UPDATE garage.car SET brand=?, model=?, numberplate=?, inscription_date=?,
                        age=?, color=?, horsepower=?, price=?, description=? WHERE $condition";
                    $requete = $connexion->prepare($sql);
                    $requete->execute($column);
                    $message .= "Voiture modifiée avec succès !";
                }
            } else if ($request =="delete") {                                   // Supprime une voiture
                $results = CarPart("select", "numberplate", $condition);
                $check = $results[0];
                if (count($check) > 1) {                                        // Si plus d'une voiture
                    $error = True;
                    $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'un produit.";
                } else {
                    $sql="DELETE FROM garage.car WHERE $condition";
                    $requete = $connexion->prepare($sql);
                    $requete->execute();
                    $message .= "Voiture supprimée avec succès !";
                }
            } else {                                                            // Retourne une voiture
                $sql="SELECT $column FROM garage.car WHERE $condition";
                $requete = $connexion->prepare($sql);
                $requete->execute();
                return array($requete->fetchAll(PDO::FETCH_ASSOC));
=======
<<<<<<< HEAD
        $condition = ($request=="delete" AND $condition=="1") ? "0" : $condition;// Evite de tous supprimer
=======
        $condition = ($request=="delete" AND $condition=="1") ? "description" : $condition;// Evite de tous supprimer
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
        $condition = ($column=="*" AND $condition=="1" AND $request!="select") ?
                     "0" : $condition;                                          // Evite de tous modifier
        if (gettype($column) == "array") {
            foreach ($column as $key => $value) {
                $column[$key] = htmlspecialchars($value);                       // Empêche le code html
                if ($key == 8) { $column[$key] = nl2br($column[$key]); }        // Conserve les sauts de lignes
            }
        }
        $message = "";
        if ($request =="add") {                                                 // Ajoute une voiture
            $results = Database("car", "numberplate", "numberplate=".$column[2]);
            $check = $results[0];
            if (count($check) > 0) {                                            // Si existe déjà
                $message .= "Une voiture avec le même numéro d'immatriculation (".$column[2].") existe déjà !<br>";
                $message .= "Veuillez utiliser le formulaire de modification pour ce produit.";
            } else {
                $sql="INSERT INTO garage.car(brand, model, numberplate, inscription_date,
                    age, color, horsepower, price, description) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $requete = $connexion->prepare($sql);
                $requete->execute($column);
                $message .= "Voiture ajoutée avec succès !";
            }
        } else if ($request =="modify") {                                       // Modifie une voiture
            $results = CarPart("select", "numberplate", $condition);
            $check = $results[0];
            if (count($check) > 1) {                                            // Si plus d'une voiture
                $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'un produit.";
            } else {
                $sql="UPDATE garage.car SET brand=?, model=?, numberplate=?, inscription_date=?,
                    age=?, color=?, horsepower=?, price=?, description=? WHERE $condition";
                $requete = $connexion->prepare($sql);
                $requete->execute($column);
                $message .= "Voiture modifiée avec succès !";
            }
        } else if ($request =="delete") {                                       // Supprime une voiture
            $results = CarPart("select", "numberplate", $condition);
            $check = $results[0];
            if (count($check) > 1) {                                            // Si plus d'une voiture
                $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'un produit.";
            } else {
                $sql="DELETE FROM garage.car WHERE $condition";
                $requete = $connexion->prepare($sql);
                $requete->execute();
                $message .= "Voiture supprimée avec succès !";
>>>>>>> 24f993ba1f7d6129c3500cf5c1ee4d685e0d56c3
            }
        } else {
            $error = True;
            $message .= "Le paramètre donné est incorrect.";
        }
<<<<<<< HEAD
        $color = ($error) ? "red" : "green";
        if ($message != "") echo "<p style='color: $color;'>".$message."</p>";
=======
        if ($message != "") echo "<p style='color: green;'>".$message."</p>";
>>>>>>> 24f993ba1f7d6129c3500cf5c1ee4d685e0d56c3
    }

    function BrandPart($request="", $column="*", $condition="1") {
        $connexion = Connexion();
<<<<<<< HEAD
        $condition = ($request=="delete" AND $condition=="1") ? "0" : $condition; // Evite de tous supprimer
=======
        $condition = ($request=="delete" AND $condition=="1") ? "length" : $condition;// Evite de tous supprimer
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
        $condition = ($column=="*" AND $condition=="1" AND $request!="select") ?
                     "0" : $condition;                                          // Evite de tous modifier
<<<<<<< HEAD
        $error = False;
        $message = "";
        if ((in_array($column, $DATABASE['garage']['brand']) and $column != 'id') or
        ($column == "*")) {                                                     // Si parametre correct
            if ($request =="add") {                                             // Ajoute une marque
                try { $results = Database("brand", "brand", "brand='".$column[0]."'"); }
                catch (Exception $e) { echo $e->getMessage(), "<br>"; }
                $check = (isset($results)) ? $results[0] : NULL;
                if (isset($check) and count($check) > 0) {                      // Si existe déjà
                    $error = True;
                    $message .= "Une marque avec le même nom (".$column[0].") existe déjà !<br>";
                    $message .= "Veuillez utiliser le formulaire de modification pour cette marque.";
                } else {
                    $models = explode(" ", $column[1]);
                    $column[2] = count($models);
                    $sql="INSERT INTO garage.brand(brand, model, length) VALUES(?, ?, ?)";
                    $requete = $connexion->prepare($sql);
                    $requete->execute($column);
                    $message .= "Marque ajoutée avec succès !";
                }
            } else if ($request =="modify") {                                   // Modifie une marque
                $results = BrandPart("select", "brand", $condition);
                $check = $results[0];
                if (count($check) > 1) {                                        // Si plus d'une marque
                    $error = True;
                    $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'une marque.";
                } else {
                    $sql="UPDATE garage.brand SET brand=?, model=?, active=? WHERE $condition";
                    $requete = $connexion->prepare($sql);
                    $requete->execute($column);
                    $message .= "Marque modifiée avec succès !";
                }
            } else if ($request =="delete") {                                   // Supprime une marque
                $results = BrandPart("select", "brand", $condition);
                $check = $results[0];
                if (count($check) > 1) {                                        // Si plus d'une marque
                    $error = True;
                    $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'une marque.";
                } else {
                    $sql="DELETE FROM garage.brand WHERE $condition";
                    $requete = $connexion->prepare($sql);
                    $requete->execute();
                    $message .= "Marque supprimée avec succès !";
                }
            } else {                                                            // Retourne une marque
                $sql="SELECT $column FROM garage.brand WHERE $condition";
                $requete = $connexion->prepare($sql);
                $requete->execute();
                return array($requete->fetchAll(PDO::FETCH_ASSOC));
=======
        $message = "";
        if ($request =="add") {                                                 // Ajoute une marque
            try { $results = Database("brand", "brand", "brand='".$column[0]."'"); }
            catch (Exception $e) { echo $e->getMessage(), "<br>"; }
            $check = (isset($results)) ? $results[0] : NULL;
            if (isset($check) and count($check) > 0) {                          // Si existe déjà
                $message .= "Une marque avec le même nom (".$column[0].") existe déjà !<br>";
                $message .= "Veuillez utiliser le formulaire de modification pour cette marque.";
            } else {
                $models = explode(" ", $column[1]);
                $column[2] = count($models);
                $sql="INSERT INTO garage.brand(brand, model, length) VALUES(?, ?, ?)";
                $requete = $connexion->prepare($sql);
                $requete->execute($column);
                $message .= "Marque ajoutée avec succès !";
            }
        } else if ($request =="modify") {                                       // Modifie une marque
            $results = BrandPart("select", "brand", $condition);
            $check = $results[0];
            if (count($check) > 1) {                                            // Si plus d'une marque
                $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'une marque.";
            } else {
                $sql="UPDATE garage.brand SET brand=?, model=?, active=? WHERE $condition";
                $requete = $connexion->prepare($sql);
                $requete->execute($column);
                $message .= "Marque modifiée avec succès !";
            }
        } else if ($request =="delete") {                                       // Supprime une marque
            $results = BrandPart("select", "brand", $condition);
            $check = $results[0];
            if (count($check) > 1) {                                            // Si plus d'une marque
                $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'une marque.";
            } else {
                $sql="DELETE FROM garage.brand WHERE $condition";
                $requete = $connexion->prepare($sql);
                $requete->execute();
                $message .= "Marque supprimée avec succès !";
>>>>>>> 24f993ba1f7d6129c3500cf5c1ee4d685e0d56c3
            }
        } else {
            $error = True;
            $message .= "Le paramètre donné est incorrect.";
        }
<<<<<<< HEAD
        $color = ($error) ? "red" : "green";
        if ($message != "") echo "<p style='color: $color;'>".$message."</p>";
=======
        if ($message != "") echo "<p style='color: green;'>".$message."</p>";
>>>>>>> 24f993ba1f7d6129c3500cf5c1ee4d685e0d56c3
    }

    function UserPart($request="", $column="*", $condition="1") {
        $connexion = Connexion();
<<<<<<< HEAD
        $condition = ($request=="delete" AND $condition=="1") ? "0" : $condition;// Evite de tous supprimer
=======
        $condition = ($request=="delete" AND $condition=="1") ? "panier" : $condition;// Evite de tous supprimer
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
        $condition = ($column=="*" AND $condition=="1" AND $request!="select") ?
                     "0" : $condition;                                          // Evite de tous modifier
        if (gettype($column) == "array") {
            foreach ($column as $key => $value) {
                $column[$key] = htmlspecialchars($value);                       // Empêche le code html
                if ($key == 6) { $column[$key] = sha1($column[$key]); }         // Transforme le mot de passe
                if ($key == 10) { $column[$key] = nl2br($column[$key]); }       // Conserve les sauts de lignes
<<<<<<< HEAD
            }
        }
        $error = False;
        $message = "";
        if ((in_array($column, $DATABASE['garage']['user']) and $column != 'id') or
        ($column == "*")) {                                                     // Si parametre correct
            if ($request =="add") {                                             // Ajoute un utilisateur
                $results = Database("user", "username", "username=".$column[5]);
                $check = $results[0];
                if (count($check) > 0) {                                        // Si existe déjà
                    $error = True;
                    $message .= "Une voiture avec le même numéro d'immatriculation (".$column[5].") existe déjà !<br>";
                    $message .= "Veuillez utiliser le formulaire de modification pour ce produit.";
                } else {
                    $sql="INSERT INTO garage.user(name, nickname, age, phone, mail,
                        username, password, inscription_date, favoris, panier, comments)
                        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $requete = $connexion->prepare($sql);
                    $requete->execute($column);
                    $message .= "Utilisateur ajouté avec succès !";
                }
            } else if ($request =="modify") {                                   // Modifie un utilisateur
                $results = UserPart("select", "username", $condition);
                $check = $results[0];
                if (count($check) > 1) {                                        // Si plus d'un utilisateur
                    $error = True;
                    $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'un utilisateur.";
                } else {
                    $sql="UPDATE garage.user SET name=?, nickname=?, age=?, phone=?, mail=?,
                        username=?, password=?, inscription_date=?, favoris=?, panier=?, comments=?,
                        banned=? WHERE $condition";
                    $requete = $connexion->prepare($sql);
                    $requete->execute($column);
                    $message .= "Utilisateur modifié avec succès !";
                }
            } else if ($request =="delete") {                                   // Supprime un utilisateur
                $results = UserPart("select", "username", $condition);
                $check = $results[0];
                if (count($check) > 1) {                                        // Si plus d'un utilisateur
                    $error = True;
                    $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'un utilisateur.";
                } else {
                    $sql="DELETE FROM garage.user WHERE $condition";
                    $requete = $connexion->prepare($sql);
                    $requete->execute();
                    $message .= "Utilisateur supprimé avec succès !";
                }
            } else {                                                            // Retourne un utilisateur
                $sql="SELECT $column FROM garage.user WHERE $condition";
                $requete = $connexion->prepare($sql);
                $requete->execute();
                return array($requete->fetchAll(PDO::FETCH_ASSOC));
=======
            }
        }
        $message = "";
        if ($request =="add") {                                                 // Ajoute un utilisateur
            $results = Database("user", "username", "username=".$column[5]);
            $check = $results[0];
            if (count($check) > 0) {                                            // Si existe déjà
                $message .= "Une voiture avec le même numéro d'immatriculation (".$column[5].") existe déjà !<br>";
                $message .= "Veuillez utiliser le formulaire de modification pour ce produit.";
            } else {
                $sql="INSERT INTO garage.user(name, nickname, age, phone, mail,
                    username, password, inscription_date, favoris, panier, comments)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $requete = $connexion->prepare($sql);
                $requete->execute($column);
                $message .= "Utilisateur ajouté avec succès !";
            }
        } else if ($request =="modify") {                                       // Modifie un utilisateur
            $results = UserPart("select", "username", $condition);
            $check = $results[0];
            if (count($check) > 1) {                                            // Si plus d'un utilisateur
                $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'un utilisateur.";
            } else {
                $sql="UPDATE garage.user SET name=?, nickname=?, age=?, phone=?, mail=?,
                    username=?, password=?, inscription_date=?, favoris=?, panier=?, comments=?,
                    banned=? WHERE $condition";
                $requete = $connexion->prepare($sql);
                $requete->execute($column);
                $message .= "Utilisateur modifié avec succès !";
            }
        } else if ($request =="delete") {                                       // Supprime un utilisateur
            $results = UserPart("select", "username", $condition);
            $check = $results[0];
            if (count($check) > 1) {                                            // Si plus d'un utilisateur
                $message .= "Veuillez donner plus de renseignement pour ne sélectionner qu'un utilisateur.";
            } else {
                $sql="DELETE FROM garage.user WHERE $condition";
                $requete = $connexion->prepare($sql);
                $requete->execute();
                $message .= "Utilisateur supprimé avec succès !";
>>>>>>> 24f993ba1f7d6129c3500cf5c1ee4d685e0d56c3
            }
        } else {
            $error = True;
            $message .= "Le paramètre donné est incorrect.";
        }
        $color = ($error) ? "red" : "green";
        if ($message != "") echo "<p style='color: $color;'>".$message."</p>";
    }

    // Use in profile.php
    function InputProfile($column, $type="varchar", $readonly=False) {          // readonly : empêche la modification
        global $patterns;
        return "<?php ".((isset($_POST[$column]) and isset($_POST['modify'.$column]) and
            preg_match($patterns[$column], $_POST[$column])) ?                  // Si envoyer et value correspond au paterne
            ModifyProfile($_SESSION['id'], $column, $_POST[$column]) : "erreur").
            " ?> <form action='' method='post'><label><input type='$type' name='$column'
            value='".$_SESSION[$column]."'".(($readonly) ? " readonly" : "").
            "></label> <input type='submit' name='modify$column' value='Modifier'></form>";
    }

    function ModifyProfile($id_profile, $column, $value) {
        global $DATABASE, $is_admin;
        $connexion = Connexion();
        $error = False;
        $message = "";
        $column = htmlspecialchars($column);                                    // Empêche le code html
        if ($column == "password") $column = sha1($column);                     // Transforme le mot de passe
        if ($column == "comments") $column = nl2br($column);                    // Conserve les sauts de lignes
        $database = ($is_admin) ? "admin" : "user";
        $user = ($is_admin) ? "adminisateur" : "utilisateur";
        if ((in_array($column, $DATABASE['garage'][$database]) and $column != 'id') or
        ($column == "*")) {                                                     // Si parametre correct
            if ($value == "") {                                                 // Si valeur non définie
                $error = True;
                $message .= "Veuillez saisir une valeur correcte !";
            } else if ($column == "id" or !in_array($column, $DATABASE['garage'][$database])) { // Si colonne incorrecte
                $error = True;
                $message .= "Ce paramètre est inconnu !";
            } else if ($column == "username") {
                    $checkUser = Database("user", "username", "username='".$value.
                        "' and id!='".$id_profile."'")[0];
                    $checkAdmin = Database("admin", "username", "username='".$value.
                        "' and id!='".$id_profile."'")[0];
                    if (count($checkUser) > 0 or count($checkAdmin) > 0) {      // Si pseudo déjà utilisé
                        $error = True;
                        $message .= "Un utilisateur ou un adminisateur a déjà ce pseudonyme !";
                    }
            } else {
                $results = Database($database, "*", "id='".$id_profile."'");
                $check = $results[0];
                if (count($check) > 1) {                                        // Si plus d'un utilisateur
                    $error = True;
                    $message .= "Plusieurs $users ont été trouvés !";
                } else if (count($check) <= 0) {                                // Si pas d'utilisateur
                    $error = True;
                    $message .= "Aucun $user n'a été trouvé !";
                }
            }
        } else {
            $error = True;
            $message .= "Le paramètre donné est incorrect.";
        }
        if (!$error) {                                                          // Si pas d'erreur quelqu'onc
            $sql="UPDATE garage.$database SET $column=? WHERE id=?";
            $requete = $connexion->prepare($sql);
            $requete->execute(array($value, $id_profile));
            $_SESSION[$column] = $value;                                        // Met à jour la session actuelle
            $message .= "Profil modifié avec succès !";
        }
<<<<<<< HEAD
        $color = ($error) ? "red" : "green";
        if ($message != "") echo "<p style='color: $color;'>$message</p>";
=======
        if ($message != "") echo "<p style='color: green;'>".$message."</p>";
>>>>>>> 24f993ba1f7d6129c3500cf5c1ee4d685e0d56c3
    }

    function get_database_options($dataname, $column): array {
        $options = array();
        $results = Database($dataname, $column);
        $data = $results[0];
        foreach ($data as $key => $value) {
            if (!in_array($value[$column], $options) and $value[$column] != "") // Si pas dans options, l'ajoute
                array_push($options, $value[$column]);
        }
        sort($options);
        return $options;
    }

    function get_dictionnary_options($dict): array {
        $options = array();
        foreach ($dict as $key => $value) {
            $choices = explode(" ", $value);                                    // Get string en array
            sort($choices);
            foreach ($choices as $key2 => $choice) {
                if (!in_array($choice, $options) and $choice != "")             // Si pas dans options, l'ajoute
                    array_push($options, $choice);
            }
        }
        sort($options);
        return $options;
    }

    function display_dictionnary($dict) {                                       // Display a dictionnary
        foreach ($dict as $key => $value) {
            if (gettype($key) == "string") {
                echo strtoupper($key)."<br><br>";
                display_dictionnary($value);
            } else echo $key." : ".$value."<br>";
        }
        echo "<br>";
    }

    function Add_id_column($dataname): string {
        $connexion = Connexion();
        if ($connexion->prepare("COL_LENGTH('garage', 'id') IS NOT NULL")) {    // Si id existe
            $supp = $connexion->prepare("ALTER TABLE garage.$dataname DROP COLUMN id;");  // La supprime
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
        try {                                                                   // Essaie d'ajouter id
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

    // ! Voir utilisations pour suppression
<<<<<<< HEAD
    function Test($dataname): array {                                           // Retourne database (inutile désormais)
=======
    function Test($dataname): array {                                           // Retourne toute une base de données (inutile désormais)
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
        $connexion = Connexion();
        $requete = $connexion->prepare("SELECT * FROM $dataname WHERE 1");
        $requete->execute();
        return array($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    function get_form_phone($phone) {                                           // Return a phone number with format 00.00.00
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
