<section>
<?php
switch ($_GET['table']) {
	case 'Epreuve':
		Epreuve();
		break;
	
	default:
		# code...
		break;
}
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