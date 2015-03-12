<?php
//include('../param/id.php');


function connexion() {
	$base = "mrbs";
	$hote ="localhost";
	$utilisateur="root";
	$mdp="";
	try {
		$pdo_options [PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO ( 'mysql:host='.$hote .';dbname='.$base, $utilisateur, $mdp );
		return $bdd;
	} 
	catch ( Exception $erreurs ) {
		echo $erreurs;
	}
	//return $bdd;
}
function gestLocaux() {
	$bdd = connexion ();
	/*try {
		$pdo_options [PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO ( 'mysql:host='.$hote .';dbname='.$base, $utilisateur, $mdp );
	}
	catch ( Exception $erreurs ) {
		echo $erreurs;
	}*/
	$reponseReq = $bdd->query ('SELECT R.room_name,  U.name, E.start_time, E.end_time FROM mrbs_room R , mrbs_users U , mrbs_entry E WHERE R.id = E.room_id AND E.create_by = U.name');
	echo '<table>';
	echo "<tr><th>Nom de la salle</th><th>nom de l'utilisateur</th><th>Du</th><th>Au</th>";
	
	while ( $donnees = $reponseReq->fetch() ) {
		echo "<tr>";
		echo "<td>" . $donnees ['room_name'] . "</td>";
		echo "<td>" . $donnees ['name'] . "</td>";
		echo "<td>".date('d/m/Y', $donnees['start_time']).' &agrave; '.date('H:i:s', $donnees['start_time'])."</td>";
		echo "<td>".date('d/m/Y', $donnees['end_time']).' &agrave; '.date('H:i:s', $donnees['end_time'])."</td>";
		echo "</tr>";
	}
	
}

function genRecap() {
	
}

?>
	