
<html>
<body>
	<header><h3>Bienvenue dans l'espace de modification<h3></header>
	<section>
		<?php
		// On renvoie dans la bonne fonction en fonction de la variable d'URL
		switch ($_GET['table']) {
			
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

			default:
			acceuil();
			break;
		}
		function acceuil(){
			echo "aucunes tables à modifier ";
		}
		// cette fonction va suivant une variable d'url, Modifier, Supprimer, ou ajouter un tuple
		function Epreuve(){
			require_once("connection.php");
			// $_GET['id'] est l'identifiant du tuple, $_GET['mode']est : supprimer, modifier
			if (isset($_GET['id'])&&isset($_GET['mode'])){
				// partie suppression
				if ($_GET['mode']=='supprimer') {
					
					// on exectute dirrectement la requette dans cette page 
					$sql="DELETE from Epreuve where numEpreuve=".$_GET['id']."";
					$res=$mysqli->query($sql);
					// si la requette retourne une erreur c'est que le champs n'est pas supprimable (Contrainte de Clé étrangère)
					if (!($res)){
						?><h4>erreur le champ est sous contrainte !</h4><?php
					}
					// Partie Modification
				}elseif ($_GET['mode']=='modifier') {
					// On prévient l'utilisateur que nous somme en mode de modification
					echo("<h4>mode de modification</h4>");
					// on recupere l'Intitule du tuble pour faire un affichage interactif
					$sql="SELECT intitule from Epreuve where numEpreuve=".$_GET['id']."";
					$res=$mysqli->query($sql);
					$row = $res->fetch_array();
					// On affiche un formulaire de modification sur la même page 
					// ce formulaire renvoie en POST les nouvelles valeurs du tuple a la page appliquerModifs.php
					// avec comme variables d'url la table et l'id du tuple a modifier 
					echo('<form method="post" action="appliquerModif.php?table=Epreuve&id='.$_GET['id'].'">');?>
					Entrez un nouvel intitullé pour <?php echo($row['intitule'])?> : <input type="text" name="intitule">
					<input type='submit'>
					</form><?php

				}
				else{
					echo ("<h4>erreur mode</h4>");
				}
				
			}
			// affichage des parties utiles de la table pour que l'utilisateur puisse modifier, supprimer ou ajouter des tuples
			$sql="SELECT * from Epreuve";
			$res=$mysqli->query($sql);
			?><table>
			<caption>Liste des Epreuves</caption>
			<thead>
				<tr>
					<th>Intitulé</th>
				</tr>
			</thead>

			<?php
			while (NULL != ($row = $res->fetch_array())) {
				echo '<tr><td>'.$row['intitule'].'</td><td><a id="modifier" href="modifier.php?table=Epreuve&mode=supprimer&id='.$row['numEpreuve'].'">Supprimer</td><td><a id="modifier" href="modifier.php?table=Epreuve&mode=modifier&id='.$row['numEpreuve'].'">Modifier</td></tr>';
			}
			echo('<form method="post" action="ajouter.php?table=Epreuve"><tr>');?>
			<td><input type="text" name="intitule" value="nouvelle Epreuve" onclick="this.value=''"></td>
			<td><input type='submit' value="ajouter Epreuve"></td>
		</form>
	</table>
</br>
<a href="Maj.php">Retour</a>
<?php
}
// fin de la fonction Epreuve


?>
</section>
</body>
</html>