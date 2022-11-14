<?php
    include("php/fonction.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Produits";
    $nav = "products";
    $tab = 0;
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>
            <?php echo $page_name; ?>
		</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width">
	</head>

	<body class="produits">
        <?php require_once "include/header.php" ?>

        <br>

		<h1>
			Nos produits
		</h1>

		<p>
			Nos meilleurs modèles !
		</p>

        <br>

        <div>
            <span>
                Base de données :
            </span>

            <form>
                <label>
                    <input type="submit" name="on" value="On"
                           onclick="<?php if (isset($_GET["on"])) { $tab = True; } ?>">
                </label>
                <label>
                    <input type="submit" name="off" value="Off"
                           onclick="<?php if (isset($_GET["off"])) { $tab = False; } ?>">
                </label>
            </form>
        </div>

        <?php if ($tab) { ?>
            <br>

            <div id="#tab">
                <table>
                    <thead>
                    <?php
                    $resultat = Database();
                    $database = $resultat[0];

                    $titre = $database[0];
                    foreach ($titre as $name=>$value) {
                        echo "<th>" . $name . "</th>";
                    }
                    ?>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($resultat as $database) {
                        foreach ($database as $colonne) {
                            echo "<tr>";
                            foreach ($colonne as $annexe=>$ligne) {
                                echo "<td>".$ligne;
                                if ($annexe == "prix") {
                                    echo " &#8364;</td>";
                                }
                                else if ($annexe == "nb chevaux") {
                                    echo " CH</td>";
                                }
                                else {
                                    echo "</td>";
                                }
                            }
                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>

        <br>

        <?php require_once "include/footer.php" ?>
	</body>
</html>
