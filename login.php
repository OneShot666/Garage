<<<<<<< HEAD
<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION, $patterns;
    $page_name = $nom_du_site . " - S'inscrire";
    $nav = "login";     // signon
    $formulaire_valid = False;
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
            <link rel="icon" type="image/png" href="images/car/icon.svg"><!--https://ionic.io/ionicons"-->
            <!--ion-icon name="car-sport-outline"></ion-icon-->
            <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
        <?php require_once "include/header.php" ?>
        <br>

        <h1>
            Rejoignez les gararistes de l'express !
        </h1>

        <p>
            En vous inscrivant, vous pourrez désormais louer et acheter vos modèles de voiture favoris.
            <br>
            Dépêchez-vous !
        </p>
        <br><br><br>

        <div>
            <nav content="Inscription" class="formulaire">
                <form action="login_page.php" method="post">
                    <label for="name">Nom :
                        <input type="varchar" name="name" placeholder="John"
                               pattern="<?= $patterns['name']; ?>" required>
                    </label>
                    <br><br>
                    <label for="nickname">Prénom :
                        <input type="varchar" name="nickname" placeholder="Smith"
                               pattern="<?= $patterns['nickname']; ?>" required>
                    </label>
                    <br><br>
                    <label for="age">Age :
                        <input type="int" name="age" placeholder="18 ans et plus" required>
                    </label>
                    <?php
                        if (isset($_POST["envoyer"]) AND $_POST["envoyer"] == "Envoyer") {
                            if ($_POST['age'] < 18) {
                                echo "Vous devez être majeur pour vous inscire sur ce site.";
                                $formulaire_valid = False;
                            } else $formulaire_valid=True;
                        }
                    ?>
                    <br><br>
                    <label for="phone">Téléphone : (+687)
                        <input type="tel" name="phone" pattern="<?= $patterns['phone']; ?>"
                               placeholder="123456">
                    </label>
                    <br><br>
                    <label for="mail">Adresse mail :
                        <input type="mail" name="mail" pattern="<?= $patterns['mail']; ?>"
                               placeholder="adresse@gmail.com">
                    </label>
                    <br><br>
                    <label for="username">Pseudonyme :
                        <input type="varchar" name="username" placeholder="John Smith"
                               pattern="<?= $patterns['username']; ?>" required>
                    </label>
                    <br><br>
                    <?php $pattern = "(?=^.{8,255}$)((?=.*d)|(?=.*W+))(?![.n])(?=.*[A-Z])(?=.*[a-z]).*"; ?>
                    <!--              Au moins 8 caractères, 1 chiffre, 1 majuscule et 1 minuscule      -->
                    <label for="password">Mot de passe :
                        <input type="password" name="password" placeholder="8 caractères minimum"
                            pattern="<?= $patterns['password'] ?>" required>    <!-- autocomplete="off" -->
                    </label>
                    <br><br>
                    <label for="passwordbis">Confirmer mot de passe :
                        <input type="password" name="passwordbis" placeholder="Entrez le mot de passe à nouveau"
                            pattern="<?= $patterns['password'] ?>" required>    <!-- autocomplete="off" -->
                    </label>
                    <?php
                        if (isset($_POST["envoyer"]) AND $_POST["envoyer"] == "Envoyer") {
                            if ($_POST['passwordbis'] != $_POST['password']) {
                                echo "Les mots de passe ne sont pas les mêmes !";
                                $formulaire_valid = False;
                            } else $formulaire_valid=True;
                        }
                    ?>
                    <br><br>
                    <input type="submit" name="envoyer" value="Envoyer">
                </form>
            </nav>
        </div>
        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
=======
<?php
    include("php/function.php");
    Connexion();
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    $page_name = $nom_du_site . " - S'inscrire";
    $nav = "login";     // signon
    $formulaire_valid = False;
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
            <link rel="icon" type="image/png" href="images/car/icon.svg"><!--https://ionic.io/ionicons"-->
            <!--ion-icon name="car-sport-outline"></ion-icon-->
            <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
        <?php require_once "include/header.php" ?>

        <br>

        <h1>
            Rejoignez les gararistes de l'express !
        </h1>

        <p>
            En vous inscrivant, vous pourrez désormais louer et acheter vos modèles de voiture favoris.
            <br>
            Dépêchez-vous !
        </p>

        <br>
        <br>
        <br>

        <div>
            <nav content="Inscription" class="formulaire">
                <form action="login_page.php" method="post">
                    <label for="name">Nom :
                        <input type="varchar" name="name" placeholder="John"
                               pattern="[a-zA-Z]{3,99}" required>
                    </label>
                    <br><br>
                    <label for="nickname">Prénom :
                        <input type="varchar" name="nickname" placeholder="Smith"
                               pattern="[a-zA-Z]{3,99}" required>
                    </label>
                    <br><br>
                    <label for="age">Age :
                        <input type="int" name="age" placeholder="18 ans et plus" required>
                    </label>
                    <?php
                        if (isset($_POST["envoyer"]) AND $_POST["envoyer"] == "Envoyer") {
                            if ($_POST['age'] < 18) {
                                echo "Vous devez être majeur pour vous inscire sur ce site.";
                                $formulaire_valid = False;
                            } else { $formulaire_valid=True; }
                        }
                    ?>
                    <br><br>
                    <label for="phone">Téléphone : (+687)
                        <input type="tel" name="phone" pattern="[0-9]{6}"
                               placeholder="123456">
                    </label>
                    <br><br>
                    <label for="mail">Adresse mail :
                        <input type="mail" name="mail"
                               placeholder="adresse@gmail.com">
                    </label>
                    <br><br>
                    <label for="username">Pseudonyme :
                        <input type="varchar" name="username" placeholder="John Smith"
                               pattern="[a-zA-Z0-9_-]{3,99}" required>
                    </label>
                    <br><br>
                    <label for="password">Mot de passe :
                        <input type="password" name="password" placeholder="8 caractères minimum"
                               pattern="[a-zA-Z0-9_-]{8,99}" required>          <!-- autocomplete="off" -->
                    </label>
                    <?php
                        if (isset($_POST["envoyer"]) AND $_POST["envoyer"] == "Envoyer") {
                            if (count($_POST['password'] < 8)) {
                                echo "Mot de passe trop court !";
                                $formulaire_valid = False;
                            } else if (!preg_match('[a-zA-Z0-9_-]', $_POST['password'])) {
                              echo "Mot de passe non sécurisé !";
                              $formulaire_valid = False;
                            } else { $formulaire_valid=True; }
                        }
                    ?>
                    <br><br>
                    <label for="passwordbis">Confirmer mot de passe :
                        <input type="password" name="passwordbis" placeholder="Entrez le mot de passe à nouveau"
                               pattern="[a-zA-Z0-9_-]{8,99}" required>          <!-- autocomplete="off" -->
                    </label>
                    <?php
                        if (isset($_POST["envoyer"]) AND $_POST["envoyer"] == "Envoyer") {
                            if ($_POST['passwordbis'] != $_POST['password']) {
                                echo "Les mots de passe ne sont pas les mêmes !";
                                $formulaire_valid = False;
                            } else { $formulaire_valid=True; }
                        }
                    ?>
                    <br><br>
                    <input type="submit" name="envoyer" value="Envoyer">
                </form>
            </nav>
        </div>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
>>>>>>> de35599262b94eb2251ba41078ff191e9fea0818
