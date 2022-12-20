<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    if (!isset($_SESSION['rights'])) {
        if (strpos($_SERVER['PHP_SELF'], '/css') or strpos($_SERVER['PHP_SELF'], '/data') or
        strpos($_SERVER['PHP_SELF'], '/images') or strpos($_SERVER['PHP_SELF'], '/include') or
        strpos($_SERVER['PHP_SELF'], '/php')) {
            header("Location: ../index.php");
        }
    }

    try {
        $database = new PDO("mysql:host=localhost; dbname=garage; charset=utf8;", "root", "");
        // $database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $database -> query("SELECT * FROM user");
    } catch (Exception $e) { die("Erreur : " . $e -> getMessage()); }

    if (isset($_POST["envoyer"]) AND $_POST["envoyer"] == "Envoyer") {
        if (!empty($_POST['name']) and !empty($_POST['nickname']) and
          !empty($_POST['age']) and !empty($_POST['username']) and
          !empty($_POST['password'])) {                                         // Si tous champs requis sont remplies
            $name = htmlspecialchars($_POST["name"]);
            $name = strip_tags($name);
            $nickname = htmlspecialchars($_POST["nickname"]);
            $nickname = strip_tags($nickname);
            $age = htmlspecialchars($_POST["age"]);
            $age = strip_tags($age);
            if (empty($_POST['phone'])) {
                $phone = "";
                echo "Champ 'phone' vide.<br>";
            } else {
                $phone = htmlspecialchars($_POST["phone"]);
                $phone = strip_tags($phone);
            }
            if (empty($_POST['mail'])) {
                $mail = "";
                echo "Champ 'mail' vide.<br>";
            } else {
                $mail = htmlspecialchars($_POST["mail"]);
                $mail = strip_tags($mail);
            }
            // ! Ajouter vérifier si username unique dans database
            $username = htmlspecialchars($_POST["username"]);                   // htmlspecialchars : Empêche code html
            $username = strip_tags($username);                                  // strip_tags : Supprime balises html
            // ! Vérifier si mot de passe sécurisé
            $password = htmlspecialchars($_POST["password"]);                   // htmlspecialchars : Contre failles
            $password = strip_tags($password);
            $password = sha1($_POST['password']);                               // sha1 : Pas très sécurisé today

            $checkUserAlreadyExist = $database->prepare("SELECT * FROM garage.user
                                     WHERE username = ? AND password = ?");
            $checkUserAlreadyExist->execute(array($username, $password));
            if ($checkUserAlreadyExist->rowCount() > 0) {                       // Si user existe déjà
                $is_connected = False;
                echo "<h2>Cet utilisateur existe déjà !</h2><br>";
                echo "<h3>Veuillez-vous connecter avec le <a href='connect.php'>
                    formulaire de connection</a> ou entrez un autre speudo</h3>";
            } else {                                                            // '?' : arg rempli avec VALUES
                $insert_user = $database->prepare("INSERT INTO garage.user
                               (name, nickname, age, phone, mail, username, password)
                               VALUES(?, ?, ?, ?, ?, ?, ?)");
                $insert_user->execute(array($name, $nickname, $age, $phone, $mail, $username, $password));
            }
            $getUser = $database->prepare("SELECT * FROM garage.user WHERE username = ? AND password = ?");
            $getUser->execute(array($username, $password));
            $_SESSION['id'] = $getUser->fetch()['id'];                          // Get user id
            $_SESSION['name'] = $name;
            $_SESSION['nickname'] = $nickname;
            $_SESSION['age'] = $age;
            $_SESSION['phone'] = $phone;
            $_SESSION['mail'] = $mail;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['favoris'] = array();
            $_SESSION['panier'] = array();
            $_SESSION['comments'] = array();
            $_SESSION['banned'] = 0;
            $is_connected = True;
            echo "Bienvenue <strong>" . $_SESSION['username'] . "</strong> !<br>";
        } else {
            $is_connected = False;
            echo "Attention ! Veuillez vérifier que tous les champs soient bien
            remplies avant d'envoyer le formulaire d'inscription.<br>";
        }
    }
    echo "<br><button style='float: right;'><a href='index.php'>Retour à l'accueil</a></button>";
    if ($is_connected) {
        echo "<button style='float: right;'><a href='profile.php'>Votre profil</a></button>";
    }
