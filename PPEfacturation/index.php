<?php 
	include("template/header.php");
	include("template/menu.php");
	include("template/footer.php");
	include("function/function.php");
	
	//function getContenu($_GET['id']){
		switch ($_GET['id']){
			case "a":
			gestLocaux();
			break;
			case"b":
			genRecap();
			break;
		}
	//}

?>