    <!-- ceci est un fichier de configuration, veuillez entrer vos donnés personneles dans ce fichier -->
    <head>
    	<meta charset="utf-8" />

    	<link rel="stylesheet" href="style.css" />
    	<title>Mini projet BDD</title>

    </head>
    <?php
    $serveur="serveur";
    $user="user";
    $pass="mdp";
    $base="base"; 
    $mysqli = new mysqli($serveur, $user, $pass, $base);
    if ($mysqli->connect_error) {
        die('Erreur de connexion ('.$mysqli->connect_errno.')'. $mysqli->connect_error);
    }

    ?>
    
