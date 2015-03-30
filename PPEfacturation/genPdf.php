<?php
	require('fpdf.php');
	include_once ("function/function.php");
	$pdf = new FPDF();
	$pdf -> SetFont('Arial','B','12');
	$pdf -> Cell(8,196,'Récapitulatif des locations',0);
	$pdf -> AddPage();
	$pdf -> Image('img/logo.png');
	$bdd = connexion();
	$req = 'SELECT * from mrbs_entry where FROM_UNIXTIME(start_time) LIKE "'.$_GET['genPdf'].'%"';
	//echo $req;
	$reponseReq = $bdd->query($req);
	
	//echo '<table>';
	//echo "<tr><th>Nom de l'utilisateur</th><th>nom de la reservation</th><th>Du</th><th>Au</th>";
	
	while ( $donnees = $reponseReq->fetch() ) {
		//$donnees = $_GET['genPdf'];
		$pdf -> Cell(8,38,$donnees['create_by']);
		$pdf -> Ln(4);
		$pdf -> Cell(48,38,$donnees['name']);
		$pdf -> Cell(88,38,date('d/m/Y', $donnees['start_time']).' à '.date('H:i:s', $donnees['start_time']));
		$pdf -> Cell(128,38,date('d/m/Y', $donnees['end_time']).' à '.date('H:i:s', $donnees['end_time']));
		
		//$pdf -> MultiCell(0,10,$donnees);
	}
	$pdf -> Output();
	//basicTable(4,$donnees);
?>