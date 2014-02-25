<!-- cette page est composé en premiere partie d'une 
	structure switch qui permet d'utiliser une fonction
	pour chaque requette a afficher -->
<section>
	<?php

	switch ($_GET['var']) {
		case 'ListeEpreuve':
		ListeEpreuve();
		break;

		case 'ListeEtu':
		?>
		<a href='Afficher.php'>Retour</a>
		<?php
		ListeEtu();
		break;

		case 'ListeMan':
		Man();
		break;

		case 'NbEtus':
		NbEtus();
		break;

		case 'AgeToto':
		?>
		<a href='Afficher.php'>Retour</a>
		<?php
		AgeToto();
		break;

		case 'EtuBelfort':
		?>
		<a href='Afficher.php'>Retour</a>
		<?php
		EtuBelfort();
		break;

		case 'NbEpreuves':
		nbEpreuves();
		break;

		case 'NbEtusEpreuves':
		NbEtusEpreuves();
		break;

		case 'totoParticipe':
		totoParticipe();
		break;
		// si la requette n'existe pas alors on affiche un message d'erreur !
		default:
		echo "erreur !!";
		break;
	}
	?>
	<!-- lien de retour a la page précédente qui sera ainsi affiché après chaque fonctions -->
	<a href='Afficher.php'>Retour</a>
</section>
<?php
// chaque fonction a la même architecture donc je n'en commenterai une seule 
function ListeEpreuve(){

	require_once("connection.php");
	// requette Sql
	$sql = 'SELECT intitule FROM Epreuve';
	// execution requette
	$res = $mysqli->query($sql);
	?><table>
	<!-- Intitulé du tableau Structuré -->
	<caption>Liste des Epreuves</caption>
	<!-- entête d'un tableau structuré -->
	<thead>
		<tr>
			<th>Intitulé</th>
		</tr>
	</thead>
	<!-- fin de l'entête -->
	<?php
	// affichage de la requette dans un tableau
	while (NULL !== ($row = $res->fetch_array())) {
		echo '<tr><td>'.$row['intitule'].'</td></tr>';
	}
	?></table><?php
}

function ListeEtu(){
	require_once("connection.php");
	$sql = 'SELECT nom, age, sexe from Etudiant';
	$res = $mysqli->query($sql);
	?><table>
	<caption>Liste des Etudiants</caption>
	<thead>
		<tr>
			<th>Nom</th>
			<th>Age</th>
			<th>Sexe</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Nom</th>
			<th>Age</th>
			<th>Sexe</th>
		</tr>
	</tfoot>
	<?php
	while (NULL !== ($row = $res->fetch_array())) {
		echo '<tr><td>'.$row['nom'].'</td><td>'.$row['age'].'</td><td>'.$row['sexe'].'</td></tr>';
	}
	?></table><?php
}

function Man(){
	require_once("connection.php");
	$sql = 'SELECT nomMan, dateMan from Manifestation where dateman>1999-02-12';
	$res = $mysqli->query($sql);
	?><table>
	<caption>Liste des Manifestations avant le 12/02/1999</caption>
	<thead>
		<tr>
			<th>Nom Manifestation</th>
			<th>Date Manifestation</th>
			
		</tr>
	</thead>
	
	<?php
	while (NULL !== ($row = $res->fetch_array())) {
		echo '<tr><td>'.$row['nomMan'].'</td><td>'.$row['dateMan'].'</td></tr>';
	}
	?></table><?php
}
function NbEtus(){
	require_once("connection.php");
	$sql = 'SELECT nbEtudiants from Iut where Iut.adresse = "Belfort";';
	$res = $mysqli->query($sql);
	$row = $res->fetch_array();
	echo 'Il y a '.$row['nbEtudiants'].' étudiants à l\'IUT de belfort';

}

function AgeToto(){
	require_once("connection.php");
	$sql = 'SELECT e2.nom From Etudiant e1, Etudiant e2 where e1.age = e2.age and e1.nom="toto"';
	$res = $mysqli->query($sql);
	?><table>
	<caption>Liste des Étudiants ayant le même age que toto</caption>
	<thead>
		<tr>
			<th>Nom</th>
			
		</tr>
	</thead>
	
	<?php
	while (NULL !== ($row = $res->fetch_array())) {
		echo '<tr><td>'.$row['nom'].'</td></tr>';
	}
	?></table><?php
}

function EtuBelfort(){
	require_once("connection.php");
	$sql = 'SELECT nom, age, sexe from Etudiant, Iut where Etudiant.noIut=Iut.noIut and Iut.adresse="Belfort";';
	$res = $mysqli->query($sql);
	?><table>
	<caption>Liste des Etudiants de L'IUT de Belfort</caption>
	<thead>
		<tr>
			<th>Nom</th>
			<th>Age</th>
			<th>Sexe</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Nom</th>
			<th>Age</th>
			<th>Sexe</th>
		</tr>
	</tfoot>
	<?php
	while (NULL !== ($row = $res->fetch_array())) {
		echo '<tr><td>'.$row['nom'].'</td><td>'.$row['age'].'</td><td>'.$row['sexe'].'</td></tr>';
	}
	?></table><?php
}

function nbEpreuves(){
	require_once("connection.php");
	$sql = 'SELECT count(Contenu.numEpreuve), Manifestation.nomMan from Contenu, Manifestation where Manifestation.numMan = Contenu.numMan Group by Contenu.numMan';
	$res = $mysqli->query($sql);
	?><table>
	<caption>Nombre d'épreuves par Manifestations</caption>
	<thead>
		<tr>
			<th>Nom Manifestation</th>
			<th>Nombre d'épreuves</th>
			
		</tr>
	</thead>
	
	<?php
	while (NULL !== ($row = $res->fetch_array())) {
		echo '<tr><td>'.$row['nomMan'].'</td><td>'.$row['count(Contenu.numEpreuve)'].'</td></tr>';
	}
	?></table><?php
}

function NbEtusEpreuves(){
	require_once("connection.php");
	$sql = 'SELECT i.nomIut, count(distinct p.noEtudiant) as nbEtudiants from Participe p, Etudiant e, Iut i where p.noEtudiant = e.noEtudiant and i.noIut = e.noIut Group by e.noIut;';
	$res = $mysqli->query($sql);
	?><table>
	<caption>Nombre d'étudians qui participent a une Manifestation</caption>
	<thead>
		<tr>
			<th>Nom Iut</th>
			<th>Nombre d'étudiants participant</th>
			
		</tr>
	</thead>
	
	<?php
	while (NULL !== ($row = $res->fetch_array())) {
		echo '<tr><td>'.$row['nomIut'].'</td><td>'.$row['nbEtudiants'].'</td></tr>';
	}
	?></table><?php
}

function totoParticipe(){
	require_once("connection.php");
	$sql = 'SELECT distinct m.nomMan from Manifestation m, Participe p, Etudiant e where m.numMan = p.numMan and p.noEtudiant=e.noEtudiant and e.nom="toto"';
	$res = $mysqli->query($sql);
	?><table>
	<caption>Toto a participé à :</caption>
	<thead>
		<tr>
			<th>Nom Manifestation</th>
			
		</tr>
	</thead>
	
	<?php
	while (NULL !== ($row = $res->fetch_array())) {
		echo '<tr><td>'.$row['nomMan'].'</td></tr>';
	}
	?></table><?php
}

?>