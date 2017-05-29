<?php
	/**
	 * Ce script php permet de recuperer les id et autres informations des pays
	 * et des villes. Si le pays et/ou la ville n'est pas dans la base de 
	 * donnees alors on enregistre ces nouvelles informations en base.
	 * 
	 * gc_town
	 * ----------------
	 * town_id
	 * town_fk_country
	 * town_postal_code
	 * town_name
	 * 
	 * gc_country
	 * ----------------
	 * country_id
	 * country_name
	 */

if($_SERVER['REQUEST_METHOD']=='POST'){
	//Getting the requested id
	/*
	$postal_code  = $_GET['town_postal_code'];
	$town_name    = $_GET['town_name'];
	$country_name = $_GET['country_name'];
	*/

	$postal_code  = $_POST['town_postal_code'];
	$town_name    = $_POST['town_name'];
	$country_name = $_POST['country_name'];
	
	
	
	/*
	$category  = $_POST['trash_temp_fk_category'];
	$datetime  = $_POST['trash_temp_date_time'];
	$latitude  = $_POST['trash_temp_latitude'];
	 */
	
	
	//utf8_encode($data)
	
	//Importing database
	require_once('dbConnect.php');
	
	//Creating sql query with where clause to get an specific employee
	$sql_search_country = "SELECT country_id,country_name 
			               FROM gc_country 
			               WHERE country_name ='".$country_name."'";
	
	//getting result 
	$result_parti = mysqli_query($con,$sql_search_country);
	
	if (!$result_parti) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
	}
	
	$number_of_row = mysqli_num_rows($result_parti);
	
	if($number_of_row == 0){
		$sql_insert = "INSERT INTO gc_country (country_name) 
				       VALUES ('".$country_name."')";
		
		if(mysqli_query($con,$sql_insert)){
			$result_parti = mysqli_query($con,$sql_search_country);
			$row_country = mysqli_fetch_object($result_parti) ;
		}else{
			echo 'Could Not Add a Country';
			echo "<br/>" ;
		}
	}else{
		$row_country = mysqli_fetch_object($result_parti) ;
	}
			
	if (!$result_parti) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
	}
	
	//--La ville---------------------------------------------------------------------------------------------
	// TODO faire une jointure avec le pays
	$sql_search_town = "SELECT town_id,town_name,town_fk_country,town_postal_code 
		                FROM gc_town
		                WHERE town_postal_code ='".$postal_code."' AND town_fk_country ='".$row_country->country_id."' limit 1";
	
	//getting result
	$result_search_town = mysqli_query($con,$sql_search_town);
	
	if (!$result_search_town) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
	}
	
	$number_of_town_row = mysqli_num_rows($result_search_town);
	
	if($number_of_town_row == 0){
		$sql_insert_town = "INSERT INTO gc_town (town_fk_country,town_postal_code,town_name)
				            VALUES ('".$row_country->country_id."',
				            		'".$postal_code."',
				            		'".$town_name."')";
	
		if(mysqli_query($con,$sql_insert_town)){
			$result_search_town = mysqli_query($con,$sql_search_town);
			$row_town = mysqli_fetch_object($result_search_town) ;
		}else{
			echo 'Could Not Add a Town';
			echo "<br/>" ;
		}
	}else{
		$row_town = mysqli_fetch_object($result_search_town) ;
	}
	
	//pushing result to an array
	$result = array();
	array_push($result,array("country_id"=>$row_country->country_id,
			                 "country_name"=>$row_country->country_name,
			                 "town_id"=>$row_town->town_id,
			                 "town_name"=>$row_town->town_name,
			                 "town_fk_country"=>$row_town->town_fk_country,
			                 "town_postal_code"=>$row_town->town_postal_code));

	//displaying in json format 
	echo json_encode(array('result'=>$result));
	mysqli_close($con);
}