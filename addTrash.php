<?php
  /**
  * Mise a jour : 12/07/16
  * 
  * Permet d'ajouter une poubelle
  * 
  * 26/05/16 Mineur :
  * Modification de l'id pour le nom des photos
  * 06/06/16 Moyenne : 
  * Modification du nom de l'image enregiste sur le serveur
  * 23/06/16 Moyenne :
  * Correction du nom des images, on avait *.jpg.png, on  maintenant *.jpg
  */
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
	//-- Image
 	$image = $_POST['image'];
 	$name  = $_POST['name'];
	//-- Infos
	$category    = $_POST['trash_temp_fk_category'];
	$datetime    = $_POST['trash_temp_date_time'];
	$latitude    = $_POST['trash_temp_latitude'];
	$longitude   = $_POST['trash_temp_longitude'];
	$address     = $_POST['trash_temp_address'];
	$town        = $_POST['trash_temp_town']; 
	$postal_code = $_POST['trash_temp_postal_code'];
	$country     = $_POST['trash_temp_country']; 
	$user        = $_POST['trash_temp_fk_user']; 
	
	$town_fk    = "";
	$country_fk = "";
	
	//Importing our db connection script
	require_once('dbConnect.php');
	
	// recherche du dernier id pour le nom de la photo
	$sql_parti ="SELECT uploads_id 
      		   FROM gc_uploads_img 
		       ORDER BY uploads_id ASC";
	$res = mysqli_query($con,$sql_parti);
	$id = 0;
	
	while($row = mysqli_fetch_array($res)){
		$id = $row['uploads_id'];
		$id = $id + 1 ;
	}
	
	// l'id doit demarrer a 1, pas a 0
	if($id == 0){
		$id = 1 ;
	}
	
	// recherche des cles primaire pour les villes et pays
	// recherche de la ville
	$sql_town = "SELECT gc_town.town_id, 
		                gc_town.town_fk_country, 
		                gc_town.town_postal_code, 
		                gc_town.town_name
				 FROM gc_town
				 WHERE gc_town.town_postal_code=$postal_code";
	
	$result_town = mysqli_query($con,$sql_town);
	$data_town   = mysqli_fetch_assoc($result_town);
	$town_fk    = $data_town['town_id'] ;
	
	// recherche du pays
	$sql_country = "SELECT country_id,
						   country_name
					FROM gc_country
					WHERE country_name='$country'";
	
	$result_country = mysqli_query($con,$sql_country);
	$data_country   = mysqli_fetch_assoc($result_country);
	$country_fk     = $data_country['country_id'] ;
	
	// traitement si le code postal est null
	// TODO
	
	$result_country = mysqli_query($con,$sql_country);
	$data_country   = mysqli_fetch_assoc($result_country);
	$country_fk     = $data_country['country_id'] ;
	
	// definition du nom de l'image et du path
	//$path       = "pics/$id.png";
	$path       = "pics/$name";
	$actualpath = "http://www.valhatech.com/trashcollector/$path";
	
	$sql_parti        = "INSERT INTO gc_uploads_img (uploads_path,uploads_name) VALUES ('$actualpath','$name')";
	
	if($result = mysqli_query($con,$sql_parti)){
		
		$uploads_id = mysqli_insert_id($con);
		file_put_contents($path,base64_decode($image));
		
		$sql2 = "INSERT INTO gc_trash_temp (trash_temp_img,
										   trash_temp_fk_category,
										   trash_temp_date_time,
										   trash_temp_latitude,
										   trash_temp_longitude,
										   trash_temp_address,
										   trash_temp_fk_town,
										   trash_temp_fk_country,
										   trash_temp_fk_user)
		VALUES ('$uploads_id',
				'$category',
				'$datetime',
				'$latitude',
				'$longitude',
				'$address',
				'$town_fk',
				'$country_fk',
				'$user')";
		
		mysqli_query($con,$sql2);
		
		echo "Successfully Uploaded";
	}else{
 		echo "Error";
 	}
	 
 	//Closing the database 
 	mysqli_close($con);
 }
 else{
 	echo "Error";
 }