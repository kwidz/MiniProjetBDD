<!-- Acceuil de la section de mise a jour -->
<?php require_once("connection.php"); ?>
<html>
<header>
		<h3>Vous pouvez ici modifier des tables.<h3>
	</header>
	<section>
		<!-- on utilise une methode get pour recuperer la table que l'on veut modifier plus facilement -->
	<form method='get' action='modifier.php'>
			<select name='table' size='1'>

				<option>Epreuve</option>
				<option>Etudiant</option>
				<option>Iut</option>
				<option>Manifestation</option>
				<option>Participe</option>
				
			</select>
			
			<input type="submit">
		</form>
		<a href="index.php">Retour</a>
	</section>
<body>