<?php
require('fpdf.php');
include_once ("function/function.php");
$pdf = new FPDF();
$pdf -> SetFont('Arial','B','12');
$pdf -> Cell(8,196,'Récapitulatif des locations par région',0);
$pdf -> AddPage();
$pdf -> Image('img/logo.png');
$bdd = connexion();
$req = 'SELECT nom_ligue, superficie_utilisee, create_by FROM mrbs_ligue, mrbs_entry';
//echo $req;
$reponseReq = $bdd->query($req);

//echo '<table>';
//echo "<tr><th>Nom de l'utilisateur</th><th>nom de la reservation</th><th>Du</th><th>Au</th>";

while ( $donnees = $reponseReq->fetch() ) {
	//$donnees = $_GET['genPdf'];
	$pdf -> Cell(48,38,$donnees['nom_ligue']);
	$pdf -> Ln(4);
	$pdf -> Cell(48,30,$donnees['superficie_utilisee']);
	$pdf -> Ln(4);
	$pdf -> Cell(48,38,$donnees['create_by']);

	//$pdf -> MultiCell(0,10,$donnees);
}
$pdf -> Output();
//basicTable(4,$donnees);
?>