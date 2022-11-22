<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    // if (!$_SESSION['username']) { header("Location: ../index.php"); }
    try {
        $database = new PDO("mysql:host=localhost; dbname=garage; charset=utf8;",
        "root", "");
        // $database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $database -> query("SELECT * FROM admin, user");
    }
    catch (Exception $e) { die("Erreur : " . $e -> getMessage()); }

    if (isset($_POST["envoyer"]) AND $_POST["envoyer"] == "Envoyer") {
        // echo "Formulaire envoyé !<br>";
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            // echo "Champs remplies.<br>";
            // ! Ajouter une fonction unique pour sécuriser les entrées de textes
            $username = htmlspecialchars($_POST["username"]);                   // htmlspecialchars : Empêche user d'entrer code html
            $username = strip_tags($username);                                  // strip_tags : Supprime balises html
            $password = htmlspecialchars($_POST["password"]);                   // htmlspecialchars : Sécure contre failles
            $password = strip_tags($password);
            $password = sha1($_POST['password']);                               // sha1 : Pas très sécurisé today
            // echo "Champs sécurisés.<br>";

            $checkAdminExist = $database->prepare("SELECT * FROM garage.admin WHERE username = ? AND password = ?");
            // $checkAdminExist->setFetchMode(PDO::FETCH_ASSOC);                   // Database en tableau associatif
            $checkAdminExist->execute(array($username, $password));
            if ($checkAdminExist->rowCount() < 1) {                             // Si admin n'existe pas
                $checkUserExist = $database->prepare("SELECT * FROM garage.user WHERE username = ? AND password = ?");
                // $checkUserExist->setFetchMode(PDO::FETCH_ASSOC);                // Database en tableau associatif
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
                    $is_connected = True;
                    $is_admin = False;

                    echo "<br>Bon retour <strong style='color: orange;'>" .
                    $_SESSION['username'] . "</strong> !<br><br>";
                } else {                                                            // Si plusieurs admins
                    $is_connected = False;
                    echo "Attention ! Plusieurs utilisateurs avec ce speudonyme existent.<br>";
                    echo "Veuillez patientez le temps que nous règlons cet imprévu.";
                }
            } else if ($checkAdminExist->rowCount() == 1) {                     // Si admin existe
                $dataAdmin = $checkAdminExist->fetch();
                $_SESSION['id'] = $dataAdmin['id'];                             // Get admin id
                $_SESSION['username'] = $dataAdmin['username'];
                $_SESSION['password'] = $dataAdmin['password'];
                $_SESSION['rights'] = $dataAdmin['rights'];
                $is_connected = True;
                $is_admin = True;                                               // A les droits admin

                echo "<br>Bon retour administrateur/trice <strong style='color: orange;'>" .
                $_SESSION['username'] . "</strong> !<br><br>";
            } else {                                                            // Si plusieurs admins
                $is_connected = False;
                echo "Attention ! Plusieurs utilisateurs avec ce speudonyme existent.<br>";
                echo "Veuillez patientez le temps que nous règlons cet imprévu.";
            }
        } else {
            echo "Attention ! Veuillez vérifier que tous les champs soient bien
            remplies avant d'envoyer le formulaire de connection.<br>";
        }
    }
    echo "<br><button><a href='connect.php'>Retour au formulaire</a></button>";
