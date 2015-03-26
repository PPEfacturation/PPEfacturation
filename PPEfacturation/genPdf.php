<?php
	require('fpdf.php');
	include_once ("function/function.php");
	$pdf = new FPDF();
	$pdf -> SetFont('Arial','B','12');
	$pdf -> Cell(0,196,'Récapitulatif des locations',0);
	$pdf -> AddPage();
	$bdd = connexion();
	$req = 'SELECT * from mrbs_entry where FROM_UNIXTIME(start_time) LIKE "'.$_GET['genPdf'].'%"';
	//echo $req;
	$reponseReq = $bdd->query($req);
	
	//echo '<table>';
	//echo "<tr><th>Nom de l'utilisateur</th><th>nom de la reservation</th><th>Du</th><th>Au</th>";
	
	while ( $donnees = $reponseReq->fetch() ) {
		//$donnees = $_GET['genPdf'];
		$pdf -> Cell(8,38,$donnees['create_by']);
		//$pdf -> Cell(8,38,$donnees['name']);
		//$pdf -> MultiCell(0,10,$donnees);
	}
	$pdf -> Output();
?>