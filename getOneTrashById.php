<?php 
	/**
	 * Mise a jour : 12/07/16
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

if($_SERVER['REQUEST_METHOD']=='POST'){

	//Getting the requested id
	//$id = $_GET['id'];
	//$country_id = $_GET['country_id'];
	
	$id         = $_POST['trash_temp_id'];
	$country_id = $_POST['country_id'];
	
	
	//Importing database
	require_once('dbConnect.php');
	
	//Creating sql query with where clause to get an specific employee
	$sql_parti = "SELECT * 
	        FROM gc_trash_temp 
	        INNER JOIN gc_uploads_img
		    ON gc_trash_temp.trash_temp_img = gc_uploads_img.uploads_id
		    INNER JOIN gc_town
		    ON gc_trash_temp.trash_temp_fk_town = gc_town.town_id
		    INNER JOIN gc_country
		    ON gc_trash_temp.trash_temp_fk_country = gc_country.country_id
	        WHERE trash_temp_id=$id";
	
	
	//getting result 
	$result_parti = mysqli_query($con,$sql_parti);
	
	//pushing result to an array 
	$result = array();
	$row = mysqli_fetch_array($result_parti);
	array_push($result,array("trash_temp_id"=>$row['trash_temp_id'],
			                 "trash_temp_img"=>$row['uploads_path'],
			                 "trash_temp_fk_category"=>$row['trash_temp_fk_category'],
							 "trash_temp_date_time"=>$row['trash_temp_date_time'],
							 "trash_temp_latitude"=>$row['trash_temp_latitude'],
							 "trash_temp_longitude"=>$row['trash_temp_longitude'],
							 "trash_temp_address"=>$row['trash_temp_address'],
			                 "town_postal_code"=>$row['town_postal_code'],
							 "town_name"=>$row['town_name'],
			                 "country_name"=>$row['country_name'],
			                 "cat_name"=>$row['cat_name']
			                 ));

	//displaying in json format 
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
}
else{
	echo "Error";
}