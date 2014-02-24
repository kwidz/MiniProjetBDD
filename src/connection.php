   <!-- ce fichier est juste un morceau de code que je voulais éviter de réécrire au 
   debut de chaque fichier je l'appelle avec require_once sur chaque page  -->
    <head>
    	<meta charset="utf-8" />

    	<link rel="stylesheet" href="style.css" />
    	<title>Mini projet BDD</title>

    </head>
    <?php
    $serveur="localhost";
    $user="root";
    $mdp="mdp";
    $DataBase="mini_projet"; 
    $connection=mysql_connect($serveur, $user, $mdp);
    mysql_select_db($DataBase, $connection);
    ?>
    
