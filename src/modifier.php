
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
			case 'Contenu':
			Contenu();
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
			<tfoot>
				<tr>
					<th>Intitulé</th>
				</tr>
			</tfoot>

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
			?><a href="Maj.php">Retour</a><?php
			$sql="Select e.noEtudiant, e.nom, e.age, e.sexe, i.nomIut  From Iut i, Etudiant e where i.noIut=e.noIut;";
			$res=$mysqli->query($sql);
			?><table>
			<caption>Liste des Etudiants</caption>
			<thead>
				<tr>
					<td>nom</td><td>age</td><td>sexe</td><td>Iut</td>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td>nom</td><td>age</td><td>sexe</td><td>Iut</td>
				</tr>
			</tfoot>

			<?php
			while (NULL != ($row = $res->fetch_array())) {
				echo '<tr><td>'.$row['nom'].'</td><td>'.$row['age'].'</td><td>'.$row['sexe'].'</td><td>'.$row['nomIut'].'</td><td><a id="modifier" href="modifier.php?table=Etudiant&mode=supprimer&id='.$row['noEtudiant'].'">Supprimer</td><td><a id="modifier" href="modifier.php?table=Etudiant&mode=modifier&id='.$row['noEtudiant'].'">Modifier</td></tr>';
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
			<tfoot>
				<tr>
					<td>nomIut</td><td>adresse</td><td>nbEtudiants</td>
				</tr>
			</tfoot>

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
			$sql="SELECT Manifestation.*, Iut.nomIut from Manifestation, Iut where Iut.noIut = Manifestation.noIut";
			$res=$mysqli->query($sql);
			?><table>
			<caption>Liste des Etudiants</caption>
			<thead>
				<tr>
					<td>nomMan</td><td>dateMan</td><td>NomIut</td>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td>nomMan</td><td>dateMan</td><td>NomIut</td>
				</tr>
			</tfoot>

			<?php
			while (NULL != ($row = $res->fetch_array())) {
				echo '<tr><td>'.$row['nomMan'].'</td><td>'.$row['dateMan'].'</td><td>'.$row['nomIut'].'</td><td><a id="modifier" href="modifier.php?table=Manifestation&mode=supprimer&id='.$row['numMan'].'">Supprimer</td><td><a id="modifier" href="modifier.php?table=Manifestation&mode=modifier&id='.$row['numMan'].'">Modifier</td></tr>';
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

/* ATTENTION Fonction Participe ne fait rien a part etre afficher car elle est en cours de creation */
function Participe(){
			require_once("connection.php");
		
			// $_GET['id'] est l'identifiant du tuple, $_GET['mode']est : supprimer, modifier
			if (isset($_GET['numMan'])&&isset($_GET['numEpreuve'])&&isset($_GET['noEtudiant'])&&isset($_GET['mode'])){
				
				if ($_GET['mode']=='supprimer') {
					
					// on exectute dirrectement la requette dans cette page 
					$sql="DELETE from Participe where numMan=".$_GET['numMan']." and numEpreuve=".$_GET['numEpreuve']." and noEtudiant=".$_GET['noEtudiant']."";
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
					$sql="SELECT * from Participe where numMan=".$_GET['numMan']." and numEpreuve=".$_GET['numEpreuve']." and noEtudiant=".$_GET['noEtudiant']."";
					$res=$mysqli->query($sql);
					$row = $res->fetch_array();
					// On affiche un formulaire de modification sur la même page 
					// ce formulaire renvoie en POST les nouvelles valeurs du tuple a la page appliquerModifs.php
					// avec comme variables d'url la table et l'id du tuple a modifier 
					echo('<form method="post" action="appliquerModif.php?table=Participe&numMan='.$row['numMan'].'&numEpreuve='.$row['numEpreuve'].'&noEtudiant='.$row['noEtudiant'].'">');?>
					<?php
					$sql2="SELECT noEtudiant, nom from Etudiant ";
					$res2=$mysqli->query($sql2);
					$row2 = $res2->fetch_array();
					?>
				
					Entrez un nouveau resultat pour cet Etudiant: <input type="text" name="resultat">
					<input type='submit'>
					</form><?php

				}
				else{
					echo ("<h4>erreur mode</h4>");
				}
				
			}
			// affichage des parties utiles de la table pour que l'utilisateur puisse modifier, supprimer ou ajouter des tuples
			?><a href="Maj.php">Retour</a><?php
			$sql="SELECT Participe.*, Manifestation.nomMan, Epreuve.intitule, Etudiant.nom from Participe, Etudiant, Manifestation, Epreuve where Participe.numMan = Manifestation.numMan and Participe.noEtudiant = Etudiant.noEtudiant and Participe.numEpreuve = Epreuve.numEpreuve";
			$res=$mysqli->query($sql);
			?><table>
			<caption>Liste de Participe</caption>
			<thead>
				<tr>
					<td>nom Etudiant</td><td>Nom Manifestation</td><td>Intitule Epreuve</td><td>Resultat</td>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td>nom Etudiant</td><td>Nom Manifestation</td><td>Intitule Epreuve</td><td>Resultat</td>
				</tr>
			</tfoot>

			<?php
			while (NULL != ($row = $res->fetch_array())) {
				echo '<tr><td>'.$row['nom'].'</td><td>'.$row['nomMan'].'</td><td>'.$row['intitule'].'</td><td>'.$row['resultat'].'</td><td><a id="modifier" href="modifier.php?table=Participe&mode=supprimer&numMan='.$row['numMan'].'&numEpreuve='.$row['numEpreuve'].'&noEtudiant='.$row['noEtudiant'].'">Supprimer</td><td><a id="modifier" href="modifier.php?table=Participe&mode=modifier&numMan='.$row['numMan'].'&numEpreuve='.$row['numEpreuve'].'&noEtudiant='.$row['noEtudiant'].'">Modifier</td></tr>';
			}
			echo('<form method="post" action="ajouter.php?table=Participe"><tr>');?>
			<?php
					$sql2="SELECT noEtudiant, nom from Etudiant ";
					$res2=$mysqli->query($sql2);
					$row2 = $res2->fetch_array();
					?>
					<td><select name="Etudiant">
						<?php 
						while (NULL != ($row2 = $res2->fetch_array())) { ?>
							<option value="<?php echo($row2["noEtudiant"])?>"><?php echo($row2["nom"])?></option><?php 
						} ?>

					</select></td>
				

			<?php
					$sql2="SELECT numMan, nomMan from Manifestation  ";
					$res2=$mysqli->query($sql2);
					$row2 = $res2->fetch_array();
					?>
					<td><select name="Manifestation">
						<?php 
						while (NULL != ($row2 = $res2->fetch_array())) { ?>
							<option value="<?php echo($row2["numMan"])?>"><?php echo($row2["nomMan"])?></option><?php 
						} ?>

					</select></td>
			<?php
					$sql2="SELECT numEpreuve, intitule from Epreuve   ";
					$res2=$mysqli->query($sql2);
					$row2 = $res2->fetch_array();
					?>
					<td><select name="Epreuve">
						<?php 
						while (NULL != ($row2 = $res2->fetch_array())) { ?>
							<option value="<?php echo($row2["numEpreuve"])?>"><?php echo($row2["intitule"])?></option><?php 
						} ?>

					</select></td>
			<td><input type="number" name="resultat" value="resultat" onclick="this.value=''"></td>
			
				
			<td><input type='submit' value="ajouter une participation"></td>
		</form>
	</table>
</br>
<a href="Maj.php">Retour</a>
<?php
}
		/* select Participe.Resultat, Manifestation.nomMan, Epreuve.intitule, Etudiant.nom 
		from Participe, Etudiant, Manifestation, Epreuve 
		where 
		Participe.numMan = Manifestation.numMan AND
		Etudiant.noEtudiant = Participe.noEtudiant AND
		Epreuve.numEpreuve = Participe.Epreuve
		*/
function Contenu(){
	require_once("connection.php");
			// $_GET['id'] est l'identifiant du tuple, $_GET['mode']est : supprimer, modifier
			if (isset($_GET['numMan'])&&isset($_GET['mode'])&&isset($_GET['numEpreuve'])){
				// partie suppression
				if ($_GET['mode']=='supprimer') {
					
					// on exectute dirrectement la requette dans cette page 
					$sql="DELETE from Contenu where numEpreuve=".$_GET['numEpreuve']."and numMan=".$_GET['numMan']."";
					echo $sql;
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
					$sql="SELECT e.intitule, m.nomMan from Epreuve e, Manifestation m where numEpreuve=".$_GET['numEpreuve']." and numMan=".$_GET['numMan']."";
					
					$res=$mysqli->query($sql);
					$row = $res->fetch_array();
					// On affiche un formulaire de modification sur la même page 
					// ce formulaire renvoie en POST les nouvelles valeurs du tuple a la page appliquerModifs.php
					// avec comme variables d'url la table et l'id du tuple a modifier 
					echo('<form method="post" action="appliquerModif.php?table=Epreuve&numEpreuve='.$_GET['numEpreuve']."&numMan=".$_GET['numMan'].'">');?>
					Entrez un nouvel intitullé pour <?php echo($row['intitule'])?> : <input type="text" name="intitule"><br/>
					Entrez un nouvel intitullé pour <?php echo($row['nomMan'])?> : <input type="text" name="nomMan">
					<input type='submit'>
					</form><?php

				}
				else{
					echo ("<h4>erreur mode</h4>");
				}
				
			}
			// affichage des parties utiles de la table pour que l'utilisateur puisse modifier, supprimer ou ajouter des tuples
			$sql="SELECT c.*, m.nomMan, e.intitule from Contenu c, Manifestation m, Epreuve e where c.numMan=m.numMan and e.numEpreuve=c.numEpreuve";
			$res=$mysqli->query($sql);
			?><table>
			<caption>Contenu</caption>
			<thead>
				<tr>
					<th>Manifestation</th>
					<th>Epreuve</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Manifestation</th>
					<th>Epreuve</th>
				</tr>
			</tfoot>

			<?php
			while (NULL != ($row = $res->fetch_array())) {
				echo '<tr><td>'.$row['nomMan'].'</td><td>'.$row['intitule'].'</td><td><a id="modifier" href="modifier.php?table=Contenu&mode=supprimer&numEpreuve='.$row['numEpreuve'].'&numMan='.$row['numMan'].'">Supprimer</td><td><a id="modifier" href="modifier.php?table=Contenu&mode=modifier&numEpreuve='.$row['numEpreuve'].'&numMan='.$row['numMan'].'">Modifier</td></tr>';
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