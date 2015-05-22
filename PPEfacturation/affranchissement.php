<?php
	include('template/header.php');
	include('template/menu.php');
	include('template/footer.php');
	include('function/function.php');
?>

<h1>Saisie Affranchissement</h1>

<form method="post" action="affranchissement.php">
<?php 
	try {
		$bdd = connexion();
		$reponseReq = $bdd->query('SELECT * FROM mrbs_ligue');
		?><label>Ligue : </label><select name="ligue"><?php 
		while ( $donnees = $reponseReq->fetch() ){
			?><option value='<?php echo $donnees["id"];?>'><?php echo $donnees["nom_ligue"]?></option><?php 
		}
	}
	catch (Exception $erreur) {
		die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
	}
	
?>
	<label>Prix unitaire : </label><input type="text" placeholder="Saisir le prix unitaire" name="nb_affranchissement" /><br />
	<input type="reset" name="effacer" />	
	<input type="submit" name="envoyer" value="Envoyer" />
</form>


<?php  
	//if (isset($_POST['envoyer'])) {
		if ( isset($_POST['ligue']) && isset($_POST['nb_affranchissement']) ) {
			$id_ligue = $_POST['ligue'];
			$nb_affranchissement = $_POST['nb_affranchissement'];
			
			try {
				//$bdd = connexion();
				$ajoutReq = $bdd->prepare('INSERT INTO affranchissement (nb_affranchissement,id_ligue) VALUES (:nb_affranchissement, :id_ligue)');
				$ajoutReq->execute( array(
					'nb_affranchissement' => $nb_affranchissement,
					'id_ligue' => $id_ligue
				)); 
			echo "Vous avez ajouté ". $nb_affranchissement." nombre d'affranchissement.";
			}
			catch (Exception $erreur) {
				die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
			}
		}
	//}
?>