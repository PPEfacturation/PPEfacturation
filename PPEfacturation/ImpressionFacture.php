<?php
	include_once("template/header.php");
	include_once("template/menu.php");
	include_once("template/footer.php");
	include ("function/function.php");
	require('fpdf.php');
?>

<form id="recap" method="get" action="ImpressionFacture.php"
	class="selectMois">
<?php 
	try {
		$bdd = connexion();
		$reponseReq = $bdd->query('SELECT * FROM mrbs_ligue');
		?><label>Choisir une ligue : </label><select name="ligue"><?php 
		while ( $donnees = $reponseReq->fetch() ){
			?><option value='<?php echo $donnees["id"];?>'><?php echo $donnees["nom_ligue"]?></option><?php 
		}
	}
	catch (Exception $erreur) {
		die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
	}
	
?></select> Choisir un mois :<select name="selectMois">
		<option value='01'>01</option>
		<option value='02'>02</option>
		<option value='03'>03</option>
		<option value='04'>04</option>
		<option value='05'>05</option>
		<option value='06'>06</option>
		<option value='07'>07</option>
		<option value='08'>08</option>
		<option value='09'>09</option>
		<option value='10'>10</option>
		<option value='11'>11</option>
		<option value='12'>12</option>
	</select> <input type="submit" id="recap" name="valid" value="valider">
</form>

<?php  
	if ( isset($_POST['ligue']) && isset($_POST['selectMois']) ) {
		$id_ligue = $_POST ['ligue'];
		$mois = $_POST ['selectMois'];
			
		try {
			$pdf = new FPDF();
			$pdf -> SetFont('Arial','B','12');
			$pdf -> Cell(8,196,'Facturation des affranchissemnts',0);
			$pdf -> AddPage();
			$pdf -> Image('img/logo.png');
			$bdd = connexion();
			$req = 'SELECT nb_affranchissement FROM affranchissement where date = \'2015'.$mois.'21\' AND id_ligue ='.$id_ligue;
			$reponseReq = $bdd->query($req);
				
			while ( $donnees = $reponseReq->fetch() ) {
				$pdf -> Cell(48,38,$donnees['nom_ligue']);
			}
			$pdf -> Output();
		}
		catch (Exception $erreur) {
			die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}
	}
?>