<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    // if (!$_SESSION['username']) { header("Location: ../index.php"); }
    try {
<<<<<<< HEAD
        $database = new PDO("mysql:host=localhost; dbname=garage; charset=utf8;", "root", "");
=======
        $database = new PDO("mysql:host=localhost; dbname=garage; charset=utf8;",
        "root", "");
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
        // $database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $database -> query("SELECT * FROM admin, user");
    } catch (Exception $e) { die("Erreur : " . $e -> getMessage()); }

    if (isset($_POST["envoyer"]) AND $_POST["envoyer"] == "Envoyer") {
<<<<<<< HEAD
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            $username = htmlspecialchars($_POST["username"]);                   // htmlspecialchars : Empêche user d'entrer code html
            $username = strip_tags($username);                                  // strip_tags : Supprime balises html
            $password = htmlspecialchars($_POST["password"]);                   // htmlspecialchars : Sécure contre failles
            $password = strip_tags($password);
            $password = sha1($_POST['password']);                               // sha1 : Pas très sécurisé today

            $checkAdminExist = $database->prepare("SELECT * FROM garage.admin WHERE username = ? AND password = ?");
            // $checkAdminExist->setFetchMode(PDO::FETCH_ASSOC);                // Database en tableau associatif
            $checkAdminExist->execute(array($username, $password));
            if ($checkAdminExist->rowCount() < 1) {                             // Si admin n'existe pas
                $checkUserExist = $database->prepare("SELECT * FROM garage.user WHERE username = ? AND password = ?");
                // $checkUserExist->setFetchMode(PDO::FETCH_ASSOC);             // Database en tableau associatif
=======
        echo "<br>";
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            // ! Ajouter une fonction unique pour sécuriser les entrées de textes
            $username = htmlspecialchars($_POST["username"]);         // htmlspecialchars : Empêche user d'entrer code html
            $username = strip_tags($username);                        // strip_tags : Supprime balises html
            $password = htmlspecialchars($_POST["password"]);         // htmlspecialchars : Sécure contre failles
            $password = strip_tags($password);
            $password = sha1($_POST['password']);                     // sha1 : Pas très sécurisé today

            $checkAdminExist = $database->prepare("SELECT * FROM garage.admin WHERE username = ? AND password = ?");
            // $checkAdminExist->setFetchMode(PDO::FETCH_ASSOC);                   // Database en tableau associatif
            $checkAdminExist->execute(array($username, $password));
            if ($checkAdminExist->rowCount() < 1) {                             // Si admin n'existe pas
                $checkUserExist = $database->prepare("SELECT * FROM garage.user WHERE username = ? AND password = ?");
                // $checkUserExist->setFetchMode(PDO::FETCH_ASSOC);                // Database en tableau associatif
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
                $checkUserExist->execute(array($username, $password));
                if ($checkUserExist->rowCount() < 1) {                          // Si user n'existe pas
                    $is_connected = False;
                    echo "Désolé, nous n'avons pas d'utilsateur à ce nom.<br>";
                    echo "Veuillez utiliser le <a href='login.php'>formulaire
                          d'inscription</a> pour pouvoir vous enregistrer.";
                } else if ($checkUserExist->rowCount() == 1) {                  // Si user existe
                    $dataUser = $checkUserExist->fetch();
                    $_SESSION['id'] = $dataUser['id'];                          // Get user id
                    $_SESSION['name'] = $dataUser['name'];
                    $_SESSION['nickname'] = $dataUser['nickname'];
                    $_SESSION['age'] = $dataUser['age'];
                    $_SESSION['phone'] = $dataUser['phone'];
                    $_SESSION['mail'] = $dataUser['mail'];
                    $_SESSION['username'] = $dataUser['username'];
                    $_SESSION['password'] = $dataUser['password'];
<<<<<<< HEAD
                    $_SESSION['inscription_date'] = $dataUser['inscription_date'];
=======
                    $_SESSION['date_inscription'] = $dataUser['date_inscription'];
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
                    $_SESSION['favoris'] = $dataUser['favoris'];
                    $_SESSION['panier'] = $dataUser['panier'];
                    $_SESSION['comments'] = $dataUser['comments'];
<<<<<<< HEAD
                    $_SESSION['banned'] = $dataUser['banned'];
                    if ($_SESSION['banned'] == 1) {
                        $is_connected = False;
                        $is_admin = False;
                        echo "<h1>Votre compte a été suspendu !</h1>";
                        echo "<h3>Contactez un administrateur pour plus d'explications.</h3>";
                    } else {
                        $is_connected = True;
                        $is_admin = False;
                        echo "<h1>Bon retour <strong style='color: orange;'>" .
                        $_SESSION['username'] . "</strong> !</h1>";
                    }
=======
                    $is_connected = True;
                    $is_admin = False;

                    echo "<h1>Bon retour <strong style='color: orange;'>" .
                    $_SESSION['username'] . "</strong> !</h1>";
<<<<<<< HEAD
>>>>>>> 73efe1e518605350820b74d46952fcad8e7eb7e9
                } else {                                                        // Si plusieurs admins
=======
                } else {                                                            // Si plusieurs admins
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
                    $is_connected = False;
                    echo "<h1>Attention ! Plusieurs utilisateurs avec ce speudonyme existent.</h1><br>";
                    echo "<h2>Veuillez patientez le temps que nous règlons cet imprévu.</h2>";
                }
            } else if ($checkAdminExist->rowCount() == 1) {                     // Si admin existe
                $dataAdmin = $checkAdminExist->fetch();
                $_SESSION['id'] = $dataAdmin['id'];                             // Get admin id
                $_SESSION['username'] = $dataAdmin['username'];
                $_SESSION['password'] = $dataAdmin['password'];
                $_SESSION['rights'] = $dataAdmin['rights'];
                $_SESSION['has_rights'] = $dataAdmin['has_rights'];
                $is_connected = True;
                $is_admin = True;                                               // A les droits admin
                echo "<h1>Bon retour administrateur/trice <strong style='color: orange;'>" .
<<<<<<< HEAD
                    $_SESSION['username'] . "</strong> !</h1>";
=======
                      $_SESSION['username'] . "</strong> !</h1>";
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
            } else {                                                            // Si plusieurs admins
                $is_connected = False;
                echo "<h1>Attention ! Plusieurs utilisateurs avec ce speudonyme existent.</h1><br>";
                echo "<h2>Veuillez patientez le temps que nous règlons cet imprévu.<h2>";
            }
        } else {
            $is_connected = False;
            echo "<h2>Attention ! Veuillez vérifier que tous les champs soient bien
<<<<<<< HEAD
                remplies avant d'envoyer le formulaire de connection.<h2>";
        }
    }
    echo "<br><button style='float: right;'><a href='index.php'>Retour à l'accueil</a></button>";
<<<<<<< HEAD
    if ($is_connected) {
        echo "<button style='float: right;'><a href='profile.php'>Votre profil</a></button>";
    }
=======
    echo "<button style='float: right;'><a href='profile.php'>Votre profil</a></button>";
=======
                  remplies avant d'envoyer le formulaire de connection.<h2>";
        }
    }
    echo "<br><br>";
    echo "<button><a href='index.php'>Retour à l'accueil</a></button>";
    echo "<button><a href='profile.php'>Votre profil</a></button>";
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
>>>>>>> 73efe1e518605350820b74d46952fcad8e7eb7e9
