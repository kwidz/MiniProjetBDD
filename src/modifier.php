
<html>
<body>
	<header><h3>Bienvenue dans l'espace de modification<h3></header>
	<section>
		<?php
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

		function Epreuve(){
			require_once("connection.php");
			if (isset($_GET['id'])&&isset($_GET['mode'])){
				if ($_GET['mode']=='supprimer') {
					# code...
				
				$sql="DELETE from Epreuve where numEpreuve=".$_GET['id']."";
				$res=$mysqli->query($sql);
				if (!($res)){
					?><h4>erreur le champ est sous contrainte !</h4><?php
				}
			}elseif ($_GET['mode']=='modifier') {
				echo("<h4>mode de modification</h4>");
				$sql="SELECT intitule from Epreuve where numEpreuve=".$_GET['id']."";
				$res=$mysqli->query($sql);
				$row = $res->fetch_array();
				
				echo('<form method="post" action="appliquerModif.php?table=Epreuve&id='.$_GET['id'].'">');?>
					Entrez un nouvel intitullé pour <?php echo($row['intitule'])?> : <input type="text" name="intitule">
					<input type='submit'>
					</form><?php

			}
			else{
				echo ("<h4>erreur mode</h4>");
			}
				
			}

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


		?>
	</section>
</body>
</html>