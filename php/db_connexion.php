<?php
    if (!$_SESSION['username']) { header("Location: index.php"); }
    $resultat = Database();
    $database = $resultat[0];

    $username = mysqli_real_escape_string($database, htmlspecialchars($_POST["username"]));
    $password = mysqli_real_escape_string($database, htmlspecialchars($_POST["password"]));
