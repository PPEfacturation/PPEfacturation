<?php
	require('fpdf.php');
	
	
	$pdf = new FPDF();
	$pdf -> SetFont('Arial','B','12');
	$pdf -> Cell(0,196,'Récapitulatif des locations',0);
	$choix = $_GET['genPdf'];
	$pdf ->AddPage();
	$pdf -> Text(8,38,$choix['create_by']);
	$pdf -> MultiCell(0,10,$choix);
	$pdf -> Output();
	
?>