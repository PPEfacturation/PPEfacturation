<?php
	include_once("template/header.php");
	include_once("template/menu.php");
	include_once("template/footer.php");
	include ("function/function.php");
?>
	<form id="recap" method="get" action="generationRecapRegion.php" class="selectLigue"><?php 
		try {
			$bdd = connexion();
			$reponseReq = $bdd->query('SELECT * FROM mrbs_ligue');
			?><label>Choisir une ligue : </label><select name="ligue"><?php 
			while ( $donnees = $reponseReq->fetch() ){
				?><option value='<?php echo $donnees["id"];?>'><?php echo $donnees["nom_ligue"];?></option><?php 
			}
		}
		catch (Exception $erreur) {
			die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}?>
		</select>
		<input type="submit" id="recap" name="valid" value="valider">
		</form>
<?php 
		if(isset($_GET['ligue'])){
			$id_ligue = $_GET["ligue"];
			genRecapFacturationLocaux($id_ligue);
		}
?>