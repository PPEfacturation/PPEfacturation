<?php
include("template/header.php");

include("template/footer.php");
include("function/function.php");
?>
<h1>Importation des impressions</h1>

<form method="get" action="importImpression.php" id="uploadImpression">
	 <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
      <input type="file" name="monfichier" />
      <input type="submit" id="valider"  name="valider"/>


</form>
<?php
$bdd = connexion();
if(isset($_GET['valider'])&& isset($_FILES['monfichier'])){
	$fichier=basename($_FILES['monfichier']['name']);
		
	$repertoireDestination = 'C:\Users\etudiant\git\PPEfacturation\PPEfacturation';
	if(move_uploaded_file($fichier,$repertoireDestination.$fichier)){
		echo"L'upload est reussi";
	}
	else {
		echo"L'upload à echoué";
	}
	if (($handle = fopen("../".$fichier, "r")) !== FALSE)
	{
		$flag = true;
		while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE)
		{
			if($flag) { $flag = false; continue; }
			$sql = "INSERT INTO mrbs_impressions (JobIndex, protocol, userName, hostAdress, hostName, Page(sheet)Printed, Pages(side)Printed, startTime, endTime, interpreterDuration, paperType, paperSize, printerNumber, color)
									VALUES ( '".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."')";
			$bdd->query($sql);
		}
		echo "Le fichier ".$fichier." Ã  Ã©tÃ© ajoutÃ© Ã  la base de donnÃ©es.\n";
		fclose($handle);
	}
	//TODO continuer la fonction et la tester , faire le traintement du fichier .dat (commande fichier CSV)
	
	/*if (is_uploaded_file($_FILES["monfichier"]["tmp_name"])) {
		if (rename($_FILES["monfichier"]["tmp_name"],
				$repertoireDestination)) {
			echo "Le fichier temporaire ".$_FILES["monfichier"]["tmp_name"].
			" a été déplacé vers ".$repertoireDestination;
		}
		else{
			echo "Le déplacement du fichier temporaire a échoué".
					" vérifiez l'existence du répertoire ".$repertoireDestination;
		}
	}
	else{
		echo "Le fichier n'a pas été uploadé (trop gros ?)";
	}*/
}

?>