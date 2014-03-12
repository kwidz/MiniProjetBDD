
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

		function Etudiant(){
			require_once("connection.php");
			// $_GET['id'] est l'identifiant du tuple, $_GET['mode']est : supprimer, modifier
			if (isset($_GET['id'])&&isset($_GET['mode'])){
				// partie suppression
				if ($_GET['mode']=='supprimer') {
					
					// on exectute dirrectement la requette dans cette page 
					$sql="DELETE from Etudiant where noEtudiant=".$_GET['id']."";
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
					$sql="SELECT nom, age, sexe from Etudiant where noEtudiant=".$_GET['id']."";
					$res=$mysqli->query($sql);
					$row = $res->fetch_array();
					// On affiche un formulaire de modification sur la même page 
					// ce formulaire renvoie en POST les nouvelles valeurs du tuple a la page appliquerModifs.php
					// avec comme variables d'url la table et l'id du tuple a modifier 
					echo('<form method="post" action="appliquerModif.php?table=Etudiant&id='.$_GET['id'].'">');?>
					Entrez un nouveau nom pour <?php echo($row['nom'])?> : <input type="text" name="nom">
					Entrez un nouvel age pour <?php echo($row['age'])?> : <input type="text" name="age">
					Entrez un nouvel sexe pour <?php echo($row['sexe'])?> : <input type="text" name="sexe">
					<?php
					$sql2="SELECT noIut, nomIut from Iut ";
					$res2=$mysqli->query($sql2);
					$row2 = $res2->fetch_array();
					?>
					Choisissez un nouvel iut pour <?php echo($row['nom'])?> : 
					<select name="Iut">
						<?php 
						while (NULL != ($row2 = $res2->fetch_array())) { ?>
							<option value="<?php echo($row2["noIut"])?>"><?php echo($row2["nomIut"])?></option><?php 
						} ?>

					</select><br/>
					<input type='submit'>
					</form><?php

				}
				else{
					echo ("<h4>erreur mode</h4>");
				}
				
			}
			// affichage des parties utiles de la table pour que l'utilisateur puisse modifier, supprimer ou ajouter des tuples
			$sql="SELECT * from Etudiant";
			$res=$mysqli->query($sql);
			?><table>
			<caption>Liste des Etudiants</caption>
			<thead>
				<tr>
					<td>nom</td><td>age</td><td>sexe</td><td>Iut</td>
				</tr>
			</thead>

			<?php
			while (NULL != ($row = $res->fetch_array())) {
				echo '<tr><td>'.$row['nom'].'</td><td>'.$row['age'].'</td><td>'.$row['sexe'].'</td><td></td><td><a id="modifier" href="modifier.php?table=Etudiant&mode=supprimer&id='.$row['noEtudiant'].'">Supprimer</td><td><a id="modifier" href="modifier.php?table=Etudiant&mode=modifier&id='.$row['noEtudiant'].'">Modifier</td></tr>';
			}
			echo('<form method="post" action="ajouter.php?table=Etudiant"><tr>');?>
			<td><input type="text" name="nom" value="nom" onclick="this.value=''"></td>
			<td><input type="text" name="age" value="age" onclick="this.value=''"></td>
			<td><input type="text" name="sexe" value="sexe" onclick="this.value=''"></td>
			<?php
					$sql2="SELECT noIut, nomIut from Iut ";
					$res2=$mysqli->query($sql2);
					$row2 = $res2->fetch_array();
					?>
					 
					<td><select name="Iut">
						<?php 
						while (NULL != ($row2 = $res2->fetch_array())) { ?>
							<option value="<?php echo($row2["noIut"])?>"><?php echo($row2["nomIut"])?></option><?php 
						} ?>

					</select></td>
			<td><input type='submit' value="ajouter Etudiant"></td>
		</form>
	</table>
</br>
<a href="Maj.php">Retour</a>
<?php
}
// fin de la fonction Etudiant
		function Iut(){
			require_once("connection.php");
			// $_GET['id'] est l'identifiant du tuple, $_GET['mode']est : supprimer, modifier
			if (isset($_GET['id'])&&isset($_GET['mode'])){
				// partie suppression
				if ($_GET['mode']=='supprimer') {
					
					// on exectute dirrectement la requette dans cette page 
					$sql="DELETE from Iut where noIut=".$_GET['id']."";
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
					$sql="SELECT nomIut, adresse, nbEtudiants from Iut where noIut=".$_GET['id']."";
					$res=$mysqli->query($sql);
					$row = $res->fetch_array();
					// On affiche un formulaire de modification sur la même page 
					// ce formulaire renvoie en POST les nouvelles valeurs du tuple a la page appliquerModifs.php
					// avec comme variables d'url la table et l'id du tuple a modifier 
					echo('<form method="post" action="appliquerModif.php?table=Iut&id='.$_GET['id'].'">');?>
					Entrez un nouveau nom pour <?php echo($row['nomIut'])?> : <input type="text" name="nomIut">
					Entrez un nouvel adresse pour <?php echo($row['adresse'])?> : <input type="text" name="adresse">
					Entrez un nouvel nbetudiants pour <?php echo($row['nbEtudiants'])?> : <input type="text" name="nbEtudiants">
					<input type='submit'>
					</form><?php

				}
				else{
					echo ("<h4>erreur mode</h4>");
				}
				
			}
			// affichage des parties utiles de la table pour que l'utilisateur puisse modifier, supprimer ou ajouter des tuples
			$sql="SELECT * from Iut";
			$res=$mysqli->query($sql);
			?><table>
			<caption>Liste des Iut</caption>
			<thead>
				<tr>
					<td>nomIut</td><td>adresse</td><td>nbEtudiants</td>
				</tr>
			</thead>

			<?php
			while (NULL != ($row = $res->fetch_array())) {
				echo '<tr><td>'.$row['nomIut'].'</td><td>'.$row['adresse'].'</td><td>'.$row['nbEtudiants'].'</td><td><a id="modifier" href="modifier.php?table=Iut&mode=supprimer&id='.$row['noIut'].'">Supprimer</td><td><a id="modifier" href="modifier.php?table=Iut&mode=modifier&id='.$row['noIut'].'">Modifier</td></tr>';
			}
			echo('<form method="post" action="ajouter.php?table=Iut"><tr>');?>
			<td><input type="text" name="nomIut" value="nomIut" onclick="this.value=''"></td>
			<td><input type="text" name="adresse" value="adresse" onclick="this.value=''"></td>
			<td><input type="text" name="nbEtudiants" value="nbEtudiants" onclick="this.value=''"></td>
			<td><input type='submit' value="ajouter Iut"></td>
		</form>
	</table>
</br>
<a href="Maj.php">Retour</a>
<?php
}
//fin de la fonction IUT
		function Manifestation(){
			require_once("connection.php");
			// $_GET['id'] est l'identifiant du tuple, $_GET['mode']est : supprimer, modifier
			if (isset($_GET['id'])&&isset($_GET['mode'])){
				// partie suppression
				if ($_GET['mode']=='supprimer') {
					
					// on exectute dirrectement la requette dans cette page 
					$sql="DELETE from Manifestation where numMan=".$_GET['id']."";
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
					$sql="SELECT nomMan, dateMan from Manifestation where numMan=".$_GET['id']."";
					$res=$mysqli->query($sql);
					$row = $res->fetch_array();
					// On affiche un formulaire de modification sur la même page 
					// ce formulaire renvoie en POST les nouvelles valeurs du tuple a la page appliquerModifs.php
					// avec comme variables d'url la table et l'id du tuple a modifier 
					echo('<form method="post" action="appliquerModif.php?table=Manifestation&id='.$_GET['id'].'">');?>
					Entrez un nouveau nom pour <?php echo($row['nomMan'])?> : <input type="text" name="nomMan">
					Entrez une nouvelle date pour <?php echo($row['nomMan'])?> : <input type="text" name="dateMan">
					<?php
					$sql2="SELECT noIut, nomIut from Iut ";
					$res2=$mysqli->query($sql2);
					$row2 = $res2->fetch_array();
					?>
					Choisissez un nouvel iut pour <?php echo($row['nomMan'])?> : 
					<select name="Iut">
						<?php 
						while (NULL != ($row2 = $res2->fetch_array())) { ?>
							<option value="<?php echo($row2["noIut"])?>"><?php echo($row2["nomIut"])?></option><?php 
						} ?>

					</select><br/>
					<input type='submit'>
					</form><?php

				}
				else{
					echo ("<h4>erreur mode</h4>");
				}
				
			}
			// affichage des parties utiles de la table pour que l'utilisateur puisse modifier, supprimer ou ajouter des tuples
			$sql="SELECT * from Manifestation";
			$res=$mysqli->query($sql);
			?><table>
			<caption>Liste des Etudiants</caption>
			<thead>
				<tr>
					<td>nomMan</td><td>dateMan</td><td>NomIut</td>
				</tr>
			</thead>

			<?php
			while (NULL != ($row = $res->fetch_array())) {
				echo '<tr><td>'.$row['nomMan'].'</td><td>'.$row['dateMan'].'</td><td></td><td><a id="modifier" href="modifier.php?table=Manifestation&mode=supprimer&id='.$row['numMan'].'">Supprimer</td><td><a id="modifier" href="modifier.php?table=Manifestation&mode=modifier&id='.$row['numMan'].'">Modifier</td></tr>';
			}
			echo('<form method="post" action="ajouter.php?table=Manifestation"><tr>');?>
			<td><input type="text" name="nomMan" value="nomMan" onclick="this.value=''"></td>
			<td><input type="text" name="dateMan" value="dateMan" onclick="this.value=''"></td>
			<?php
					$sql2="SELECT noIut, nomIut from Iut ";
					$res2=$mysqli->query($sql2);
					$row2 = $res2->fetch_array();
					?>
					<td><select name="Iut">
						<?php 
						while (NULL != ($row2 = $res2->fetch_array())) { ?>
							<option value="<?php echo($row2["noIut"])?>"><?php echo($row2["nomIut"])?></option><?php 
						} ?>

					</select></td>
			<td><input type='submit' value="ajouter Manifestation"></td>
		</form>
	</table>
</br>
<a href="Maj.php">Retour</a>
<?php
}

function Participe(){
			
}
?>
</section>
</body>
</html>