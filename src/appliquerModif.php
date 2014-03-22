<!-- cette page sert a executer les requettes pour modifier des tuples dans chaque tables 
Il y a une fonction par Table -->
<section>
<?php
// On utilise une fonction en fonction de la table, la table est choisie par une variable d'url (GET)
switch ($_GET['table']) {
	case 'Epreuve':
		Epreuve();
		break;
	case 'Etudiant':
		Etudiant();
		break;
	// si la variable d'url n'est pas une table alors on affiche un message d'erreur
	case 'Iut':
		Iut();
		break;
	case 'Manifestation':
		Manifestation();
		break;
	case 'Participe':
		Participe();
		break;
	default:
		echo "<h4>erreur champs !</h4><br/><a href=modifier.php?table=Epreuve>Retour</a>";
		break;
}
// dans chaques fonctions de modification de tuple, on recupere les champs par une methode POST pour eviter de surcharger l'URL
function Epreuve(){
	require_once('connection.php');
	if(!($_POST['intitule']=='')){
	$sql="UPDATE Epreuve SET intitule='".$_POST['intitule']."' WHERE numEpreuve='".$_GET['id']."'";
	
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
	$sql="UPDATE Etudiant SET nom='".$_POST['nom']."',age='".$_POST['age']."', sexe='".$_POST['sexe']."' , noIut='".$_POST['Iut']."' WHERE noEtudiant='".$_GET['id']."'";
	
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
	$sql="UPDATE Iut SET nomIut='".$_POST['nomIut']."',adresse='".$_POST['adresse']."', nbEtudiants='".$_POST['nbEtudiants']."' WHERE noIut='".$_GET['id']."'";
	
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
	$sql="UPDATE Manifestation SET nomMan='".$_POST['nomMan']."',dateMan='".$_POST['dateMan']."', noIut='".$_POST['Iut']."' WHERE numMan='".$_GET['id']."'";
	
	$res=$mysqli->query($sql);
	echo "<h4>La modification a été bien prise en compte !</h4><br/><a href=modifier.php?table=Manifestation>Retour</a>";
}
else {
	echo "<h4>Le champ est vide !</h4><br/><a href=modifier.php?table=Manifestation>Retour</a>";
}
}

function Participe(){
	require_once('connection.php');
	if(!($_POST['resultat']=='')){
	$sql="UPDATE Participe SET resultat='".$_POST['resultat']."' WHERE numMan=".$_GET['numMan']." and numEpreuve=".$_GET['numEpreuve']." and noEtudiant=".$_GET['noEtudiant']."";
	
	$res=$mysqli->query($sql);
	echo "<h4>La modification a été bien prise en compte !</h4><br/><a href=modifier.php?table=Participe>Retour</a>";
}
else {
	echo "<h4>Le champ est vide !</h4><br/><a href=modifier.php?table=Participe>Retour</a>";
}
}

?>
</section>

