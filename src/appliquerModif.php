<!-- cette page sert a executer les requettes pour modifier des tuples dans chaque tables 
Il y a une fonction par Table -->
<section>
<?php
// On utilise une fonction en fonction de la table, la table est choisie par une variable d'url (GET)
switch ($_GET['table']) {
	case 'Epreuve':
		Epreuve();
		break;
	// si la variable d'url n'est pas une table alors on affiche un message d'erreur
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
}?>
</section>