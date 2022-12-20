<?php
    include("php/function.php");
    global $nom_du_site, $is_connected, $is_admin, $_SESSION;
    Redirection("a");
    $page_name = $nom_du_site . " - Produits";
    $nav = "products";
    $tab_car = 0;
    $tab_brand = 0;
    $tab_user = 0;
?>

<!-- Qd JS, conserver valeur bool ($tab_...) qd refresh page -->

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

	<body class="produits">
        <?php require_once "include/header.php" ?>
        <br>

		<h1>
			Nos produits
		</h1>
        <br>

        <div>
            <h3>
                Nos voitures :
            </h3>

            <form>
                <label>
                    <input type="submit" name="on_car" value="On"
                        onclick="<?php if (isset($_GET["on_car"])) $tab_car = True; ?>">
                </label>
                <label>
                    <input type="submit" name="off_car" value="Off"
                        onclick="<?php if (isset($_GET["off_car"])) $tab_car = False; ?>">
                </label>
            </form>
        </div>
        <br>

        <?php if ($tab_car) { ?>
            <div id="#tab_car">
                <table>
                    <thead>
                        <?php
                            $resultat = Database("car");
                            $database = $resultat[0];

                            $titre = $database[0];
                            foreach ($titre as $name=>$value) {
                                echo "<th>".$name."</th>";
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
                                        if ($annexe == "price") { echo " &#8364;"; }
                                        else if ($annexe == "horsepower") { echo " CH"; }
                                        echo "</td>";
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

        <div>
            <h3>
                Nos marques :
            </h3>

            <form>
                <label>
                    <input type="submit" name="on_brand" value="On"
                        onclick="<?php if (isset($_GET["on_brand"])) $tab_brand = True; ?>">
                </label>
                <label>
                    <input type="submit" name="off_brand" value="Off"
                        onclick="<?php if (isset($_GET["off_brand"])) $tab_brand = False; ?>">
                </label>
            </form>
        </div>
        <br>

        <?php if ($tab_brand) { ?>
            <div id="#tab_brand">
                <table>
                    <thead>
                        <?php
                            $resultat = Database("brand");
                            $database = $resultat[0];

                            $titre = $database[0];
                            foreach ($titre as $name=>$value) {
                                echo "<th>".$name."</th>";
                            }
                        ?>
                    </thead>

                    <tbody>
                        <?php
                            foreach ($resultat as $database) {
                                foreach ($database as $colonne) {
                                    echo "<tr>";
                                    foreach ($colonne as $annexe=>$ligne) {
                                        echo "<td>".$ligne."</td>";
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

        <div>
            <h3>
                Nos utilisateurs :
            </h3>

            <form>
                <label>
                    <input type="submit" name="on_user" value="On"
                        onclick="<?php if (isset($_GET["on_user"])) $tab_user = True; ?>">
                </label>
                <label>
                    <input type="submit" name="off_user" value="Off"
                        onclick="<?php if (isset($_GET["off_user"])) $tab_user = False; ?>">
                </label>
            </form>
        </div>
        <br>

        <?php if ($tab_user) { ?>
            <div id="#tab_user">
                <table>
                    <thead>
                        <?php
                            $resultat = Database("user");
                            $database = $resultat[0];

                            $titre = $database[0];
                            foreach ($titre as $name=>$value) {
                                echo "<th>".$name."</th>";
                            }
                        ?>
                    </thead>

                    <tbody>
                        <?php
                            foreach ($resultat as $database) {
                                foreach ($database as $colonne) {
                                    echo "<tr>";
                                    foreach ($colonne as $annexe=>$ligne) {
                                        echo "<td>";
                                        echo ($annexe == "phone" and $ligne != "") ? 
                                            "+687 ".get_form_phone($ligne) : $ligne;
                                        if ($annexe == "age") { echo " ans"; }
                                        echo "</td>";
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
