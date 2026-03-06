# projet-garage
A site made in order to present a panel of available cars for a car seller.

Documentation Projet Garage :


Prérequis :

    • Un interpréteur de langage HTML/PHP ;
    • Un logiciel de gestion de serveur local pour les bases de données (Xampp de préférence) ;

Pour une meilleure compréhension, nous prendrons l’exemple de Xampp comme logiciel de gestion de serveur local.

Importation du projet en local :

    • Allez sur https://github.com/OneShot666/projet-garage et téléchargez le fichier .zip du projet en cliquant sur « Code » puis « Download ZIP » ;


    • Déplacez ce fichier dans votre gestionnaire de serveur local dans : C://xampp/htdocs/, créez un dossier nommé « Garage », déplacez-y le fichier et dézippez-le ;


    • Vous devriez obtenir une architecture de ce style :




Importation de la base de données :

    • Allez dans : C://xampp/mysql/data/ puis créez le dossier « garage » ;


    • Accédez à vos bases de données en entrant dans l’url de votre navigateur « localhost/phpmyadmin », cliquer ensuite sur le bouton « Importer » dans la barre en haut ;


    • Sélectionnez le fichier nommé « garage.sql » dans C://xampp/htdocs/Garage/data/ ;


    • La base de données « garage » devrait s’être ajoutée à vos bases de données ;


    • Allez ensuite dans C://xampp/mysql/garage;
    • Les fichiers suivants devraient s’y trouver :


    • Lancez le gestionnaire de serveur local sur votre ordinateur (vérifiez que Xampp est bien actif dans votre barre des tâches et que Apache et Mysql sont activés) puis ouvrez un navigateur et entrez dans l’url « localhost/Garage » ;
    • Le site devrait donc se lancer correctement !


Exportation de la base de données :

    • Pour exporter la base de données « garage », aller dans votre navigateur et taper dans l’url « localhost/phpmyadmin » ;



    • Sélectionnez la base de données « garage » puis cliquer sur le bouton « Exporter » sur la barre en haut ;



    • Sélectionnez le dossier dans lequel vous souhaitez enregistrer votre base de données ;
    • Vous pouvez désormais importer ce fichier à tout moment pour restaurer cette version de votre base de données.
