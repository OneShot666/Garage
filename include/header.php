<?php
    if (!$_SESSION['username']) { header("Location: ../index.php"); }
    include_once("php/function.php");                                           // Allow to use Nav_item function
?>

<link rel="stylesheet" type="text/css" href="css/style.css">

<!-- ! Ajouter : Si bool is_connected, affiche profile.php et logout.php,
     sinon affiche login.php et connect.php -->
<header class="menu">
    <div class="title">
        <h1>
            <?php echo $nom_du_site; ?>
        </h1>
    </div>

    <div class="collapse navbar-collapse">
        <ul class="menu_sommaire navbar-nav mr-auto">
            <?php if ($is_connected) { ?>
                <?= Nav_item('logout.php', 'Se déconnecter'); ?>
                <?= Nav_item('profile.php', "Profil"); ?>
            <?php } else { ?>
                <?= Nav_item('connect.php', 'Se connecter'); ?>
                <?= Nav_item('login.php', "S'inscrire"); ?>
            <?php } ?>
            <?= Nav_item('index.php', 'Accueil', 'float: left; margin-left: -30px;'); ?>
            <?= Nav_item('products.php', 'Produits', "float: left;"); ?>
            <?= Nav_item('design.php', 'Design', "float: left;"); ?>
            <!--?= Nav_item('admin.php', 'Admin', "float: left;"); ?-->
            <?= Nav_item('contact.php', 'Contact', "float: left;"); ?>
            <?= Nav_item('about.php', 'About', "float: left;"); ?>
        </ul>
    </div>
</header>

<br><br><br><br><br><br><br><br>
