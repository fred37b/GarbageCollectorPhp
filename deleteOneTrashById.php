<?php 
	/**
	 * Mise a jour : 12/07/16
	 * 
	 * Permet de supprimer un dechet ainsi que son image associee.
	 * 
	 * 06/06/16 Mineur :
  	 * on utilise desormais le vrais nom de l'image et plus un nom base sur 
  	 * l'id
  	 * 
  	 * 01/07/16 Mineur :
  	 * Correction du nom de l'image, ce qui empeche la suppression
	 * 
	 * gc_trash_temp
	 * ----------------
	 * trash_temp_id
     * trash_temp_img
     * trash_temp_fk_category
     * trash_temp_date_time
     * trash_temp_latitude
     * trash_temp_longitude
     * trash_temp_address
     * trash_temp_fk_town
     * trash_temp_fk_country
     * trash_temp_fk_user
     * 
     * garbagecollectordb
     * 
	 */
	//Getting the requested id
	$id = $_GET['id'];
	
	//Importing database
	require_once('dbConnect.php');
	
	//-- on recupere les infos du dechet et de l'image
	$sql_select_img = "SELECT *
					   FROM gc_trash_temp tt
					   INNER JOIN gc_uploads_img ui
					   ON ui.uploads_id = tt.trash_temp_img
					   WHERE tt.trash_temp_id = $id" ;
	
	$result_img = mysqli_query($con,$sql_select_img);
	$data_img   = mysqli_fetch_assoc($result_img);
	
	//$id_trash_temp        = $data_img['trash_temp_id'] ;
	$id_trash_temp        = $data_img['uploads_name'] ;
	$path_image_to_delete = $data_img['uploads_path'] ;
	
	//-- suppression du dechet ainsi que de son image associee
	$sql1 = "DELETE gc_trash_temp, gc_uploads_img 
             FROM gc_trash_temp, gc_uploads_img 
             WHERE gc_trash_temp.trash_temp_id = $id 
             AND gc_trash_temp.trash_temp_img = gc_uploads_img.uploads_id;";
	mysqli_query($con,$sql1);
	
	$dir = opendir("/pics/"); // ouverture du dossier
	$path = 'pics/'.$id_trash_temp.'';
	unlink($path);
	closedir($dir);
	
	mysqli_close($con);