<?php
    include_once("php/fonction.php");
?>

<header class="menu">
    <div class="title">
        <h1>
            Express Car
        </h1>
    </div>

    <div class="collapse navbar-collapse">
        <ul class="menu_sommaire navbar-nav mr-auto">
            <?= Nav_item('connect.php', 'Se connecter'); ?>
            <?= Nav_item('login.php', "S'inscrire"); ?>
            <?= Nav_item('accueil.php', 'Accueil', 'float: left; margin-left: -30px;'); ?>
            <?= Nav_item('products.php', 'Produits', "float: left;"); ?>
            <?= Nav_item('design.php', 'Design', "float: left;"); ?>
            <?= Nav_item('about.php', 'About', "float: left;"); ?>
        </ul>
    </div>
</header>

<br><br><br><br><br><br><br>
