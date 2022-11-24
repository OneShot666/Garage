<?php
if (!isset($_SESSION['rights'])) {
    if (strpos($_SERVER['PHP_SELF'], '/include') or strpos($_SERVER['PHP_SELF'], '/php')) {
        header("Location: ../index.php");
    }
}
?>

<div>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <footer class="credits">
        <div class="contacts">
            Nous contacter

            <ul>
                <li>
                    Téléphone : +687 16 42 69
                </li>
                <li>
                    Mail : <a href="mailto: contact@expresscar.com">contact@expresscar.com</a>
                </li>
                <li>
                    Adresse : 3 rue de Potier, Normandie
                </li>
            </ul>
        </div>

        <div class="medias">
            Nous suivre sur les réseaux sociaux

            <ul style="display: flex;">
                <li>
                    <a href="https://www.facebook.com" target="_blank">
                        <img class="logo" style="background-color: lightblue;"
                        alt="Facebook" src="images/footer/facebook_logo.png">
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com" target="_blank">
                        <img class="logo" style="background-color: lightpink;"
                        alt="Instagram" src="images/footer/instagram_logo.png">
                    </a>
                </li>
                <li>
                    <a href="https://www.twitter.com" target="_blank">
                        <img class="logo" style="background-color: powderblue;"
                        alt="Twitter" src="images/footer/twitter_logo.png">
                    </a>
                </li>
                <li>
                    <a href="https://www.linkedin.com" target="_blank">
                        <img class="logo" style="background-color: lightskyblue;"
                        alt="LinkedIn" src="images/footer/linkedin_logo.png">
                    </a>
                </li>
            </ul>
        </div>
    </footer>

    <p class="copyright">
        &copy; Copyright - <a href="#">Charte de confidentialité</a> - <a href="#">Mentions légales</a>
    </p>
</div>
