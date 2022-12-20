<?php
    if (!empty($_POST)) {
        // https://www.php.net/manual/en/function.extract.php
        extract($_POST, EXTR_OVERWRITE);    // extract : Transforme prefixe en var (['ui'=>'nop'] -> $ui = 'nop');

        if (isset($_POST['avatar'])) {
            if (isset($_FILES['file']) and !empty($_FILES['file']['name'])) {   // Si fichier existe
                $filename = $_FILES['file']['tmp_name'];
                // https://www.php.net/manual/fr/function.getimagesize.php
                list($width_orig, $height_orig) = getimagesize($filename);      // getimagesize : Get file size
                $minsize = 200;
                $maxsize = 2000;

                if ($minsize <= $height_orig && $height_orig <= $maxsize &&
                    $minsize <= $width_orig && $width_orig <= $maxsize){        // Si file size correct
                    $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg',
                        'png' => 'image/png', 'gif' => 'image/gif');
                    $ListeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg'=>'image/pjpeg');
                    $megaOctect = array('2'=>2097152, '3'=>3145728, '4'=>4194304,
                        '5'=>5242880, '7'=>7340032, '10'=>10485760, '12'=>12582912);
                    $tailleMax = $megaOctect['5'];
                    $extensionsValides = array('jpg','jpeg');                   // Formats acceptés

                    if ($_FILES['file']['size'] <= $tailleMax) {                // Si taille <= à 5 Mo
                        // Get extension image (ap pt)
                        $extensionUpload = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));

                        if (in_array($extensionUpload, $extensionsValides)) {   // Vérifie extension correcte
                            $dossier = "images/user/";
                            $nom = $_SESSION['id'].".jpg";
                            $image = $dossier.$nom;

                            if (!is_dir($dossier)) {                            // Si dossier n'existe pas : le créé
                                mkdir($dossier);
                                // md5 : similaire à sha1
                                // uniqid : génère un string random aussi
                                $nom = md5(uniqid(rand(), True));   // Génère nom unique
                            } else if (file_exists($image) && isset($_SESSION['avatar']))
                                // https://www.php.net/manual/fr/function.unlink.php
                                unlink($image);                                 // Si image existe, la supprime

                            // move_uploaded_file : déplace image dans dossier
                            $resultat = move_uploaded_file($_FILES['file']['tmp_name'], $dossier);

                            if ($resultat) {                                    // Si move succès, compresse image
                                if (is_readable($image)) {
                                    $verif_ext = getimagesize($image);

                                    if ($verif_ext['mime'] == $ListeExtension[$extensionUpload] ||
                                        $verif_ext['mime'] == $ListeExtensionIE[$extensionUpload]) {    // Check extensions
                                        $filename = $image;                     // Save chemin image dans filename

                                        $extension = array('jpg', 'jpeg', 'pjpg', 'pjpeg');
                                        if (in_array($extensionUpload, $extension)) // Check extensions
                                            // https://www.php.net/manual/en/function.imagecreatefromjpeg.php
                                            $image2 = imagecreatefromjpeg($filename);

                                        $width2 = 300;
                                        $height2 = 300;
                                        list($width_orig, $height_orig) = getimagesize($filename);
                                        // https://www.php.net/manual/en/function.imagecreatetruecolor.php
                                        $image_p2 = imagecreatetruecolor($width2, $height2);    // Redimensionnement
                                        // https://www.php.net/manual/en/function.imagealphablending.php
                                        imagealphablending($image_p2, False);   // Set colors and transparence
                                        // https://www.php.net/manual/en/function.imagesavealpha.php
                                        imagesavealpha($image_p2, True);        // Keep alpha info
                                        $point2 = 0;                            // Calcul news dimensions
                                        $ratio = null;

                                        if ($width_orig <= $height_orig) $ratio = $width2 / $width_orig;
                                        else if ($width_orig > $height_orig) $ratio = $height2 / $height_orig;

                                        $width2 = ($width_orig * $ratio) + 1;
                                        $height2 = ($height_orig * $ratio) + 1;
                                        // Copy and resize part of an image with resampling
                                        imagecopyresampled($image_p2, $image2, 0, 0, $point2, 0,
                                            $width2, $height2, $width_orig, $height_orig);
                                        imagedestroy($image2);                  // Destroy the image

                                        if (in_array($extensionUpload, $extension)) {   // Check extensions
                                            header('Content-Type: image/jpeg'); // Output image
                                            $exif = exif_read_data($filename);  // Read exif header (?)
                                            if (!empty($exif['Orientation'])) {
                                                switch ($exif['Orientation']) {
                                                    case 8:
                                                        $image_p2 = imagerotate($image_p2,90,0);
                                                        break;
                                                    case 3:
                                                        $image_p2 = imagerotate($image_p2,180,0);
                                                        break;
                                                    case 6:
                                                        $image_p2 = imagerotate($image_p2,-90,0);
                                                        break;
                                                }
                                            }
                                            imagejpeg($image_p2, $image, 75);   // Affichage
                                            imagedestroy($image_p2);
                                        }

                                        $DB->insert("UPDATE garage.user SET avatar=? WHERE id=?",
                                            array(($nom), $_SESSION['id']));
                                        $_SESSION['avatar'] = ($nom);           // Met à jour avatar
                                        $_SESSION['flash']['success'] = "Nouvel avatar enregistré !";
                                        exit;
                                    } else $_SESSION['flash']['warning'] = "Le type MIME de l'image n'est pas bon !";
                                }
                            } else $_SESSION['flash']['error'] = "Erreur lors de l'importation de votre photo !";
                        } else $_SESSION['flash']['warning'] = "Votre photo doit être au format 'jpg' !";
                    } else $_SESSION['flash']['warning'] = "Votre photo de profil ne doit pas dépasser 5 Mo !";
                } else $_SESSION['flash']['warning'] = "Dimension de l'image compris entre $minsize et $maxsize !";
            } else $_SESSION['flash']['warning'] = "Veuillez mettre une image !";
        }
    }
?>
