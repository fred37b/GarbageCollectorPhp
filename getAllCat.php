<?php
	/**
	 * Mise a jour : 12/07/16
	 *   
	 * Script utilisé au demarrage de l'application il permet de recuperer les 
	 * categories, dans la langues du pays, ou par defaut en anglais
	 * 
	 * 07/06/16 Majeur :
	 * Ajout d'un garde fou, si on ne trouve pas de categorie associees au pays
	 *  dans lequel on est on utilise celui de l'angleterre, dont l'id est 12, 
	 *  les categories sont alors en anglais.
	 *  
	 * Permet de recuperer une liste de categorie a partir d'un pays.
	 * 
	 * Le nom des champs de la table XXX sont :
	 * - cat_id
	 * - cat_fk_country 	
	 * - cat_name 
	 * 
	 **/
 
	//Getting the key of the country
	$cat_fk_country = $_GET['cat_fk_country'];

	//Importing Database Script
	require_once('dbConnect.php');
	
	//Creating sql query
	$sql_parti = "SELECT * FROM gc_category 
	        WHERE cat_fk_country=$cat_fk_country";
	
	//getting result
	$result_parti = mysqli_query($con,$sql_parti);
	
	//creating a blank array
	$result = array();
	
	//looping through all the records fetched
	while($row = mysqli_fetch_array($result_parti)){
		//Pushing name and id in the blank array created
		array_push($result,array("cat_id"=>$row['cat_id'],
				                 "cat_fk_country"=>$row['cat_fk_country'],
				                 "cat_number"=>$row['cat_number'],
				                 "cat_name"=>$row['cat_name']));
	}
	
	$empty = empty($result) ;
	
	if($empty == 1){
		// si il n'y a pas de categorie dans la langue du pays alors on utilise
		// l'anglais
		$sql_parti = "SELECT * FROM gc_category
		        WHERE cat_fk_country=12";
		
		//getting result
		$result_parti = mysqli_query($con,$sql_parti);
		
		//creating a blank array
		$result = array();
		
		//looping through all the records fetched
		while($row = mysqli_fetch_array($result_parti)){
			//Pushing name and id in the blank array created
			array_push($result,array("cat_id"=>$row['cat_id'],
					                 "cat_fk_country"=>$row['cat_fk_country'],
					                 "cat_number"=>$row['cat_number'],
					                 "cat_name"=>$row['cat_name']));
		}
		
		echo json_encode(array('result'=>$result));
	}else{
		echo json_encode(array('result'=>$result));
	}
	
	mysqli_close($con);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	