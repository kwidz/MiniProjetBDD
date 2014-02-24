    <head>
    	<meta charset="utf-8" />

    	<link rel="stylesheet" href="style.css" />
    	<title>Mini projet BDD</title>

    </head>
    <?php
    $serveur="localhost";
    $user="root";
    $pass="mdp";
    $base="mini_projet"; 
    $mysqli = new mysqli($serveur, $user, $pass, $base);
    if ($mysqli->connect_error) {
        die('Erreur de connexion ('.$mysqli->connect_errno.')'. $mysqli->connect_error);
    }

    ?>
    
