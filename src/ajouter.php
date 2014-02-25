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
}?>
</section>