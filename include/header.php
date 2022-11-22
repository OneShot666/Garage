<?php
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    // echo ($is_connected) ? "<h2>Connecté(e) !</h2>" : "<h2>Non connecté(e) !</h2>";
    // if (!$_SESSION['username']) { header("Location: ../index.php"); }

    function Nav_item(string $lien, string $titre, string $style = "") {
        $classe = 'nav-item';
        if ($_SERVER["SCRIPT_NAME"] === $lien) {
            $classe .= ' active';
        }
        echo '<li class="'.$classe.'" style="'.$style.'"><a class="nav-link" href="'.$lien.'">'.$titre.'</a></li>';
    }
?>

<link rel="stylesheet" type="text/css" href="css/style.css">

<header class="menu">
    <div class="title">
        <h1>
            <?php echo $nom_du_site; ?>
        </h1>
    </div>

    <div class="collapse navbar-collapse">
        <ul class="menu_sommaire navbar-nav mr-auto">
            <?php
                if ($is_connected) {
                  Nav_item('logout.php', 'Se déconnecter');
                  Nav_item('profile.php', "Profil");
                } else {
                  Nav_item('connect.php', 'Se connecter');
                  Nav_item('login.php', "S'inscrire");
                }
                Nav_item('index.php', 'Accueil', 'float: left; margin-left: -30px;');
                if ($is_admin) {
                    Nav_item('products.php', 'Produits', "float: left;");
                    Nav_item('design.php', 'Design', "float: left;");
                    Nav_item('admin.php', 'Admin', "float: left;");
                }
                Nav_item('contact.php', 'Contact', "float: left;");
                Nav_item('about.php', 'A propos', "float: left;");
            ?>
        </ul>
    </div>
</header>

<br><br><br><br><br><br><br><br>
