<?php
	/**
	 * Mise a jour : 06/06/16
	 * 
	 * Script etant effectue toute les 6 heures pour supprimer les ordures qui 
	 * ont plus de 24h.
	 * 
	 * 06/06/16 Mineur :
  	 * on utilise desormais le vrais nom de l'image et plus un nom base sur 
  	 * l'id
  	 * 29/06/16 Mineur :
  	 * Suppression de l'extension *.png dans la creation du chemin de l'image
	 */
	//Importing database
	require_once('dbConnect.php');
	
	//--- Recuperer l'heure actuel
	$dateTime = date("Y-m-d H:i:s");
	$datetime1 = date_create($dateTime);
	
	//---Recuperer les objets le dechet et l'image associe
	$sql_parti = "SELECT *
			FROM gc_trash_temp
			INNER JOIN gc_uploads_img
			ON gc_uploads_img.uploads_id = gc_trash_temp.trash_temp_img";
	
	//getting result
	$result_parti = mysqli_query($con,$sql_parti);
	//creating a blank array
	$result = array();
	
	//looping through all the records fetched
	while($row = mysqli_fetch_array($result_parti)){
		
		//$trashTempId = $row['trash_temp_id'] ;
		$trashTempId     = $row['trash_temp_id'] ;
		$uplaodImageName = $row['uploads_name'] ;
		
		$datetime2   = date_create($row['trash_temp_date_time']);
		$interval    = date_diff($datetime1, $datetime2);
		$numberOfDay = $interval->format('%a');
		
		if($numberOfDay >= 40){//precedement a 32
			
			$dir = opendir("/pics/");            // ouverture du dossier
			$path = 'pics/'.$uplaodImageName.''; // creation du chemin de l'image
			unlink($path);                       // suppression de l'image
			closedir($dir);                      // fermeture du repertoire
			
			$sql_to_delete = "DELETE gc_trash_temp, gc_uploads_img
							  FROM gc_trash_temp, gc_uploads_img
							  WHERE gc_trash_temp.trash_temp_id = $trashTempId
							  AND gc_trash_temp.trash_temp_img = gc_uploads_img.uploads_id;";
				
			mysqli_query($con,$sql_to_delete);
			
		}
	}
	
	mysqli_close($con);