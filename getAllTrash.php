<?php 
	/**
	 * Mise a jour : 12/07/16
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

	//Importing Database Script 
	require_once('dbConnect.php');
	 
	//Creating sql query
	$sql_parti = "SELECT * 
			FROM gc_trash_temp
			INNER JOIN gc_category
			ON gc_trash_temp.trash_temp_fk_category = gc_category.cat_id";
	 

	//getting result 
	$result_parti = mysqli_query($con,$sql_parti);
	 
	//creating a blank array 
	$result = array();
	 
	//looping through all the records fetched
	while($row = mysqli_fetch_array($result_parti)){
		//Pushing name and id in the blank array created 
		array_push($result,array("trash_temp_id"=>$row['trash_temp_id'],
				                 "trash_temp_img"=>$row['trash_temp_img'],
				                 "trash_temp_latitude"=>$row['trash_temp_latitude'],
				                 "trash_temp_longitude"=>$row['trash_temp_longitude'],
				                 "trash_temp_date_time"=>$row['trash_temp_date_time'],
				                 "cat_name"=>$row['cat_name']));
	}
	 
	//Displaying the array in json format 
	echo json_encode(array('result'=>$result));
	 
	mysqli_close($con);