<?php
	echo "cible php" ;
	
	$save = "save" ;
	$del  = "del" ;
	
	$case0     = $_POST['case0'];
	$id_trash0 = $_POST['id_trash0'];
	$id_img0   = $_POST['id_img0'];
	$url_img0  = $_POST['url_img0'];
	
	$case1     = $_POST['case1'];
	$id_trash1 = $_POST['id_trash1'];
	
	$case2     = $_POST['case2'];
	$id_trash2 = $_POST['id_trash2'];
	
	$case3     = $_POST['case3'];
	$id_trash3 = $_POST['id_trash3'];
	
	$case4     = $_POST['case4'];
	$id_trash4 = $_POST['id_trash4'];
	
	$case5     = $_POST['case5'];
	$id_trash5 = $_POST['id_trash5'];
	
	$case6     = $_POST['case6'];
	$id_trash6 = $_POST['id_trash6'];
	
	$case7     = $_POST['case7'];
	$id_trash7 = $_POST['id_trash7'];
	
	$case8     = $_POST['case8'];
	$id_trash8 = $_POST['id_trash8'];
	
	$case9     = $_POST['case9'];
	$id_trash9 = $_POST['id_trash9'];
	
	require_once('dbConnect.php');
	
	echo "</br>" ;
	echo "------" ;
	echo "</br>" ;
	
	/*
	 //-- on recupere les infos du dechet et de l'image
	 $sql_select_img = "SELECT *
						 FROM gc_trash_temp tt
						 INNER JOIN gc_uploads_img ui
						 ON ui.uploads_id = tt.trash_temp_img
						 WHERE tt.trash_temp_id = $id" ;
	
	 $result_img = mysqli_query($con,$sql_select_img);
	 
	 	DELETE p, pa
      	FROM pets p
      	JOIN pets_activities pa ON pa.id = p.pet_id
     	WHERE p.order > :order
       	AND p.pet_id = :pet_id

Alternatively you can use...

		DELETE pa
		FROM pets_activities pa
      	JOIN pets p ON pa.id = p.pet_id
 		WHERE p.order > :order
   		AND p.pet_id = :pet_id
	 
	 DELETE messages , usersmessages  
	 FROM messages  
	 INNER JOIN usersmessages  
     WHERE messages.messageid= usersmessages.messageid and messages.messageid = '1'
	 
	 */
	//DELETE FROM `valhatecxhbdd`.`gc_trash_temp` WHERE `gc_trash_temp`.`trash_temp_id` = 1» ?
	
	if($case0 == "save" ){
		echo "save 0" ;
		echo "</br>" ;
		echo $id_trash0 ;
		echo "</br>" ;
		echo $id_img0 ;
		echo "</br>" ;
		echo $url_img0 ;
		echo "</br>" ;
	}else {
		if($case0 == "del" ){
			echo "del 0" ;
			echo "</br>" ;
			
			echo $url_img0 ;
			echo "</br>" ;
			
			//$path  = "http://www.valhatech.com/trashcollector/pics";
			$dir = opendir("/pics/"); // ouverture du dossier
			$path = 'pics/'.$id_trash0.'.png';
			echo $path ;
			echo "</br>" ;
			$unlink_result = unlink($path);        // suppression de l'image
			echo $unlink_result ;
			echo "</br>" ;
			closedir($dir);
			
			$sql_to_delete = "DELETE gc_trash_temp, gc_uploads_img
					          FROM gc_trash_temp, gc_uploads_img
					          WHERE gc_trash_temp.trash_temp_id = $id_trash0
					          AND gc_trash_temp.trash_temp_img = gc_uploads_img.uploads_id;";
			
			$result_img = mysqli_query($con,$sql_to_delete);
			echo $result_img ;
			echo "</br>" ;
		}
	}
	if($case1 == "save" ){
		echo "save 1" ;
		echo "</br>" ;
	}else {
		if($case1 == "del" ){
			echo "del 1" ;
			echo "</br>" ;
		}
	}
	if($case2 == "save" ){
		echo "save 2" ;
		echo "</br>" ;
	}else {
		if($case2 == "del" ){
			echo "del 2" ;
			echo "</br>" ;
		}
	}
	if($case3 == "save" ){
		echo "save 3" ;
		echo "</br>" ;
	}else {
		if($case3 == "del" ){
			echo "del 3" ;
			echo "</br>" ;
		}
	}
	if($case4 == "save" ){
		echo "save 4" ;
		echo "</br>" ;
	}else {
		if($case4 == "del" ){
			echo "del 4" ;
			echo "</br>" ;
		}
	}
	if($case5 == "save" ){
		echo "save 5" ;
		echo "</br>" ;
	}else {
		if($case5 == "del" ){
			echo "del 5" ;
			echo "</br>" ;
		}
	}
	if($case6 == "save" ){
		echo "save 6" ;
		echo "</br>" ;
	}else {
		if($case6 == "del" ){
			echo "del 6" ;
			echo "</br>" ;
		}
	}
	if($case7 == "save" ){
		echo "save 7" ;
		echo "</br>" ;
	}else {
		if($case7 == "del" ){
			echo "del 7" ;
			echo "</br>" ;
		}
	}
	if($case8 == "save" ){
		echo "save 8" ;
		echo "</br>" ;
	}else {
		if($case8 == "del" ){
			echo "del 8" ;
			echo "</br>" ;
		}
	}
	if($case9 == "save" ){
		echo "save 9" ;
		echo "</br>" ;
	}else {
		if($case9 == "del" ){
			echo "del 9" ;
			echo "</br>" ;
		}
	}
	
	
	
	
	echo "------" ;
	echo "</br>" ;
	