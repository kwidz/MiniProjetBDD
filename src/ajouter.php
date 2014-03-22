<!-- cette page sert a executer les requettes pour ajouter des tuples dans chaque tables 
Il y a une fonction par Table -->

<section>
<?php
// On utilise une fonction en fonction de la table, la table est choisie par une variable d'url (GET)
switch ($_GET['table']) {
	// si la variable d'url n'est pas une table alors on affiche un message d'erreur
	case 'Epreuve':
		Epreuve();
		break;
	case 'Etudiant':
		Etudiant();
		break;
	case 'Iut':
		Iut();
		break;
	case 'Manifestation':
		Manifestation();
		break;
	case 'Participe':
		Participe();
		break;
	case 'Contenu':
		Contenu();
		break;
	default:
		echo "<h4>aucune table selectionnée ou table erronée !</h4><br/><a href=modifier.php?table=Epreuve>Retour</a>";
		break;
}
// dans chaque fonctions d'ajout de tuple, on recupere les champs par une methode POST pour eviter de surcharger l'URL
function Epreuve(){
	require_once('connection.php');
	if(!($_POST['intitule']=='')){
	$sql="INSERT into Epreuve(numEpreuve, intitule) values('','".$_POST['intitule']."')";
	
	$res=$mysqli->query($sql);
	echo "<h4>La modification a été bien prise en compte !</h4><br/><a href=modifier.php?table=Epreuve>Retour</a>";
}
else {
	echo "<h4>Le champ est vide !</h4><br/><a href=modifier.php?table=Epreuve>Retour</a>";
}
}

function Etudiant(){
	require_once('connection.php');
	if(!($_POST['nom']=='')&&!($_POST['age']=='')&&!($_POST['sexe']=='')&&!($_POST['Iut']=='')){
	$sql="INSERT into Etudiant(noEtudiant, nom, age, sexe, noIut) values('','".$_POST['nom']."','".$_POST['age']."','".$_POST['sexe']."','".$_POST['Iut']."')";
	
	$res=$mysqli->query($sql);
	echo "<h4>La modification a été bien prise en compte !</h4><br/><a href=modifier.php?table=Etudiant>Retour</a>";
}
else {
	echo "<h4>Le champ est vide !</h4><br/><a href=modifier.php?table=Etudiant>Retour</a>";
}
}

function Iut(){
	require_once('connection.php');
	if(!($_POST['nomIut']=='')&&!($_POST['adresse']=='')&&!($_POST['nbEtudiants']=='')){
	$sql="INSERT into Iut(noIut, nomIut, adresse, nbEtudiants) values('','".$_POST['nomIut']."','".$_POST['adresse']."','".$_POST['nbEtudiants']."')";
	
	$res=$mysqli->query($sql);
	echo "<h4>La modification a été bien prise en compte !</h4><br/><a href=modifier.php?table=Iut>Retour</a>";
}
else {
	echo "<h4>Le champ est vide !</h4><br/><a href=modifier.php?table=Iut>Retour</a>";
}
}

function Manifestation(){
	require_once('connection.php');
	if(!($_POST['nomMan']=='')&&!($_POST['dateMan']=='')&&!($_POST['Iut']=='')){
	$sql="INSERT into Manifestation(numMan, nomMan, dateMan, noIut) values('','".$_POST['nomMan']."','".$_POST['dateMan']."','".$_POST['Iut']."')";
	
	$res=$mysqli->query($sql);
	echo "<h4>La modification a été bien prise en compte !</h4><br/><a href=modifier.php?table=Manifestation>Retour</a>";
}
else {
	echo "<h4>Le champ est vide !</h4><br/><a href=modifier.php?table=Manifestation>Retour</a>";
}
}


function Participe(){
	require_once('connection.php');
	if(!($_POST['Etudiant']=='')&&!($_POST['Epreuve']=='')&&!($_POST['Manifestation']=='')&&!($_POST['resultat']=='')){
	$sql="INSERT into Participe(numMan, numEpreuve, noEtudiant, resultat) values('".$_POST['Manifestation']."','".$_POST['Epreuve']."','".$_POST['Etudiant']."','".$_POST['resultat']."')";
	
	$res=$mysqli->query($sql);
	echo "<h4>La modification a été bien prise en compte !</h4><br/><a href=modifier.php?table=Participe>Retour</a>";
}
else {
	echo "<h4>Le champ est vide !</h4><br/><a href=modifier.php?table=Participe>Retour</a>";
}
}

function Contenu(){
	require_once('connection.php');
	if(!($_POST['Epreuve']=='')&&!($_POST['Manifestation']=='')){
	$sql="INSERT into Contenu(numMan, numEpreuve) values('".$_POST['Manifestation']."','".$_POST['Epreuve']."')";
	
	$res=$mysqli->query($sql);
	echo "<h4>La modification a été bien prise en compte !</h4><br/><a href=modifier.php?table=Contenu>Retour</a>";
}
else {
	echo "<h4>Le champ est vide !</h4><br/><a href=modifier.php?table=Contenu>Retour</a>";
}
}

?>
</section>