<div class="contenu">
	<?php 
		/*include 'template/header';
		include 'template/menu';
		include 'template/footer';
		include 'function/function';
		//if($_GET['id']=="b"){*/
			
	?>
	<form id="recap" method="get" action="generationRecap.php" class="selectAnnee">
		Saisir une ann�e :<input type ="text" id="recap" name="selectAnnee">
		<input type="submit" id="recap" name="valid" value="valider">
	</form>
	
	<?php 
			if(isset($_GET['selectAnnee'])){
				$annee = $_GET['selectAnnee'];
				genRecap($annee); 
			}		
			
			
	?>	
	
	

</div>
