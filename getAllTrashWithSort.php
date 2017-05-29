<?php 
    /**
     * Mise a jour : 12/07/16
     *
     * Permet de recuperer une liste de poubelles selon une categorie
     *
     * 24/05/16 Mineur :
     * Ajout de l'obtention de la cle etrangere du pays pour la categorie
     * Selection des objets via le cat number et plus le cat id
     * 
     * 26/05/16 Mineur :
     * Modification de l'id pour le nom des photos
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
     * gc_category
     * --------------
     * cat_id
     * cat_fk_country
     * cat_name 
	 */
	//Getting the requested id and the number
	//$id         = $_GET['cat_id'];
	$number     = $_GET['cat_number'];
	//$fk_country = $_GET['cat_fk_country'];
	
	//Importing database
	require_once('dbConnect.php');
	
	if($number == 0){
		$sql_parti = "SELECT *
				FROM gc_trash_temp
				INNER JOIN gc_uploads_img
		        ON gc_trash_temp.trash_temp_img = gc_uploads_img.uploads_id";
	}else{
		$sql_parti = "SELECT *
		        FROM gc_trash_temp
		        INNER JOIN gc_uploads_img
		        ON gc_trash_temp.trash_temp_img = gc_uploads_img.uploads_id
		        WHERE gc_trash_temp.trash_temp_fk_category=$number";
	}
	

	//getting result 
	$result_parti = mysqli_query($con,$sql_parti);
	
	//pushing result to an array 
	$result = array();
	//looping through all the records fetched
	while($row = mysqli_fetch_array($result_parti)){
		//Pushing name and id in the blank array created 
		
		array_push($result,array("trash_temp_id"=>$row['trash_temp_id'],
				                 "trash_temp_img"=>$row['uploads_path'],
				                 "trash_temp_latitude"=>$row['trash_temp_latitude'],
				                 "trash_temp_longitude"=>$row['trash_temp_longitude'],
				                 "trash_temp_date_time"=>$row['trash_temp_date_time'],
				                 "catNumber"=>$row['trash_temp_fk_category']
				                 
		));
		
	}

	//displaying in json format 
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);