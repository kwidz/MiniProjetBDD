 
<?php require_once("connection.php"); 
?>
<!-- Menu pour les affichages des différentes requettes du TD -->
<html>
<body>
	<header>
		<h3>Vous pouvez ici consulter des information sur les olympiades.<h3>
	</header>
	<section>
		<!-- Utilisation d'une variable d'URL pour acceder a la fonction d'affichage souaitée  -->
	<a href='requettes.php?var=ListeEpreuve'>Liste des Epreuves</a>
	<a href='requettes.php?var=ListeEtu'>Liste des Étudiants</a>
	<a href='requettes.php?var=ListeMan'>Liste des manifestations ayant lieu apres le 12/04/09</a>
	<a href='requettes.php?var=NbEtus'>Nombre d'Etudiants à l'IUT de Belfort</a><br/>
	<a href='requettes.php?var=AgeToto'>Liste des Etudiants ayant le meme age que toto</a>
	<a href='requettes.php?var=EtuBelfort'>Liste des Etudiants A l'IUT de Belfort</a>
	<a href='requettes.php?var=NbEpreuves'>nombre d'épreuves par Manifestations</a>
	<a href='requettes.php?var=NbEtusEpreuves'>nombre d'Étudiants par IUT qui ont participés à une Manifestation</a>
	<a href='requettes.php?var=totoParticipe'>Manifestations auxquelles toto à participé. </a>
	<a href='index.php'>Retour</a>
</section>
</body>