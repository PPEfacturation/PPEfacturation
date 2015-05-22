<?php
	include_once("template/header.php");
	include_once("template/menu.php");
	include_once("template/footer.php");
	include ("function/function.php");
/*?>
	<form id="recap" method="get" action="generationRecapRegion.php" class="selectAnnee">
		Saisir une année :<input type ="text" id="recap" name="selectAnnee">
		<input type="submit" id="recap" name="valid" value="valider">
	</form>
<?php */
	genRecapFacturationLocaux();
?>