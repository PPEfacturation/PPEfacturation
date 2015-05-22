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
	$reponseReq = $bdd->query ('SELECT DISTINCT R.room_name,  U.name, E.start_time, E.end_time FROM mrbs_room R , mrbs_users U , mrbs_entry E WHERE R.id = E.room_id AND E.create_by = U.name');
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



function genRecap($annee) {
	$bdd = connexion();
	$req = 'SELECT DISTINCT * from mrbs_entry where FROM_UNIXTIME(start_time) LIKE "'.$annee.'%"';
	//echo $req;
	$reponseReq = $bdd->query($req);

	echo '<table>';
	echo "<tr><th>Nom de l'utilisateur</th><th>nom de la reservation</th><th>Du</th><th>Au</th>";
	
	while ( $donnees = $reponseReq->fetch() ) {
		echo "<tr>";
		echo "<td>" . $donnees ['create_by'] . "</td>";
		echo "<td>" . $donnees ['name'] . "</td>";
		echo "<td>".date('d/m/Y', $donnees['start_time']).' &agrave; '.date('H:i:s', $donnees['start_time'])."</td>";
		echo "<td>".date('d/m/Y', $donnees['end_time']).' &agrave; '.date('H:i:s', $donnees['end_time'])."</td>";
		
		echo "</tr>";
		
		
	}
	
	echo"<tr>";
	echo '<form id="choix" method="get" action="genPdf.php" class="action">
							<input type="submit"  id="choix" name="choix" value="Génerer un pdf"/>
							<input type="hidden"  id="genPdf" name="genPdf" value="'.$annee.'"/></form>';
	echo"</th>";
	echo"</table>";
	
	
	
}

function genRecapFacturationLocaux($id_ligue) {
	$bdd = connexion();
	$req = 'SELECT COUNT(id_ligue) FROM mrbs_entry WHERE id_ligue = '.$id_ligue;
	$reponseReq = $bdd->query($req);
	if($reponseReq > 5){
		$req2 = 'SELECT nom_ligue, superficie_utilisee, create_by 
				FROM mrbs_ligue ml, mrbs_entry me 
				WHERE ml.id = me.id_ligue 
				AND id_ligue = '.$id_ligue;
		$reponseReq2 = $bdd->query($req2);
		
		
		echo '<form id="choix" method="get" action="genPdfRegion.php" class="action">
		<input type="submit"  id="choix" name="choix" value="Génerer un pdf"/></form>';
		echo "<table>";
		echo "<tr><th>Nom de la ligue</th><th>Superficie utilisée</th><th>Réservation de</th></tr>";
		
		while ($donnees = $reponseReq2->fetch()){
			echo "<tr>";
			echo "<td>".$donnees['nom_ligue']."</td>";
			echo "<td>".$donnees['superficie_utilisee']."</td>";
			echo "<td>".$donnees['create_by']."</td>";
			echo "</tr>";
		}
		echo"</table>";	
	}
	else{
		echo ("Les réservations de salles sont inférieures à 6.");
	}
}


function basicTable($header, $data)
{
	// En-tête
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
	// Données
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(40,6,$col,1);
		$this->Ln();
	}
}
?>
	
