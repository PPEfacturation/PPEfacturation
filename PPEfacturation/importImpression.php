<?php
include("template/header.php");
include("template/footer.php");
?>
<h1>Importation des impressions</h1>

<form method="get" action="importImpression.php" id="uploadImpression">
	 <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
      <input type="file" name="monfichier" />
      <input type="submit" id="valider"  name="valider"/>


</form>
<?php
if(isset($_GET['valider'])&& isset($_FILES['monfichier'])){
	$fichier=basename($_FILES['monfichier']['name']);
		
	$repertoireDestination = 'C:\Users\etudiant\git\PPEfacturation\PPEfacturation';
	if(move_uploaded_file($fichier,$repertoireDestination.$fichier)){
		echo"L'upload est reussi";
	}
	else {
		echo"L'upload � echou�";
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