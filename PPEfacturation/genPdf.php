<?php
	require('fpdf.php');
	
	
	$pdf = new FPDF();
	$pdf -> AddPage();
	$pdf -> SetFont('Arial','B','12');
	$pdf -> Cell(0,10,'Edité le',0);
	
	
	$choix = $_GET['choix'];
	$pdf ->AddPage();
	$txt = file_get_contents($choix);
	$pdf -> MultiCell(0,10,$txt);
	$pdf -> Output();
	
?>