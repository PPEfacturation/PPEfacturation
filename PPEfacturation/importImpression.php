<?php
include("template/header.php");
include("template/menu.php");
include("template/footer.php");
include("function/function.php");
?>
<h1>Importation des impressions</h1>

<form method="post" action="importImpression.php" id="uploadImpression" enctype="multipart/form-data">
	 <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
      <input type="file" name="monfichier" />
      <input type="submit" id="valider"  name="valider"/>


</form>
<?php
$bdd = connexion();
if(isset($_POST['valider'])&& isset($_FILES['monfichier'])){
	//$fichier=basename($_FILES['monfichier']['name']);
	$fichier = $_FILES['monfichier'];
	//$repertoireDestination = "C:\Users\etudiant\git\PPEfacturation\PPEfacturation\\file\\";
	$repertoireDestination = "file/";
	$deplacement = move_uploaded_file($fichier['tmp_name'],$repertoireDestination.$fichier['name']);
	if($deplacement != false){
		echo "L upload est reussi";
	}
	else {
		echo"L upload à echoué";
	}
	if (($handle = fopen($repertoireDestination.$fichier['name'], "r")) !== FALSE)
	{
		
		while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE)
		{
			
			$sql = "INSERT INTO mrbs_impressions (jobIndex, protocol, userName, hostAdress, hostName, page(sheet)Printed, page(side)Printed, startTime, endTime, interpreterDuration, paperType, paperSize, printerNumber, color)
									VALUES ( '".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."')";
			$bdd->query($sql);
		
		echo "Le fichier ".$fichier['name']." à été ajouté à la base de données.\n";
		fclose($handle);
		}
	}
	//TODO continuer la fonction et la tester , faire le traintement du fichier .dat (commande fichier CSV)
	
	/*if (is_uploaded_file($_FILES["monfichier"]["tmp_name"])) {
		if (rename($_FILES["monfichier"]["tmp_name"],
				$repertoireDestination)) {
			echo "Le fichier temporaire ".$_FILES["monfichier"]["tmp_name"].
			" a �t� d�plac� vers ".$repertoireDestination;
		}
		else{
			echo "Le d�placement du fichier temporaire a �chou�".
					" v�rifiez l'existence du r�pertoire ".$repertoireDestination;
		}
	}
	else{
		echo "Le fichier n'a pas �t� upload� (trop gros ?)";
	}*/
	
}

?>