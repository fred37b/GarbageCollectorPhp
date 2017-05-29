<?php
  /**
   * Mise a jour : 23/06/16
   *
   * Permet de changer la categorie d'un dechet
   *
   */
if($_SERVER['REQUEST_METHOD']=='POST'){

	$trash_temp_id = $_POST['trash_temp_id'];
	$cat_number    = $_POST['cat_number'];
	
	//Importing our db connection script
	require_once('dbConnect.php');

	$sql_parti = "UPDATE gc_trash_temp 
			SET trash_temp_fk_category = '".$cat_number."' 
			WHERE trash_temp_id = '".$trash_temp_id."'";
	
	//getting result
	$result_update = mysqli_query($con,$sql_parti);
	
	if (!$result_update) {
		echo "Error";
	}else{
		echo "Successfully Updated";	
	}	
	
	//Closing the database
	mysqli_close($con);
}