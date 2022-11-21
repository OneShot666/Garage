<?php
    if (!$_SESSION['username']) { header("Location: ../index.php"); }
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
            $checkAdminExist->execute(array($username, $password));
            if ($checkAdminExist->rowCount() < 1) {                             // Si admin n'existe pas
                $checkUserExist = $database->prepare("SELECT * FROM garage.user WHERE username = ? AND password = ?");
                $checkUserExist->execute(array($username, $password));
                if ($checkUserExist->rowCount() < 1) {                          // Si user n'existe pas
                    echo "Désolé, nous n'avons pas d'utilsateur à ce nom.<br>";
                    echo "Veuillez utiliser le <a href='login.php'>formulaire
                    d'inscription</a> pour pouvoir vous enregistrer.";
                } else if ($checkUserExist->rowCount() == 1) {                  // Si user existe
                    // echo "Utilisateur connecté(e) !<br>";
                    $_SESSION['id'] = $checkUserExist->fetch()['id'];           // Get user id
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;

                    echo "Bon retour <strong>" . $_SESSION['username'] . "</strong> !<br>";
                } else {                                                            // Si plusieurs admins
                    echo "Attention ! Plusieurs utilisateurs avec ce speudonyme existent.<br>";
                    echo "Veuillez patientez le temps que nous règlons cet imprévu.";
                }
            } else if ($checkAdminExist->rowCount() == 1) {                     // Si admin existe
                // echo "Administrateur/trice connecté(e) !<br>";
                $_SESSION['id'] = $checkAdminExist->fetch()['id'];              // Get admin id
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;

                echo "Bon retour administrateur/trice <strong>" . $_SESSION['username'] . "</strong> !<br>";
            } else {                                                            // Si plusieurs admins
                echo "Attention ! Plusieurs utilisateurs avec ce speudonyme existent.<br>";
                echo "Veuillez patientez le temps que nous règlons cet imprévu.";
            }
        } else {
            echo "Attention ! Veuillez vérifier que tous les champs soient bien
            remplies avant d'envoyer le formulaire de connection.<br>";
        }
    }
    echo "<br><button><a href='connect.php'>Retour au formulaire</a></button>";
