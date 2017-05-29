<?php

	/**
	 * Mise a jour : 25/05/16 19:12
	 *
     */
	//Importing our db connection script
	require_once('dbConnect.php');

	//Creating sql query
	//$sql = "SELECT * FROM gc_trash_temp";
	$sql_parti = "SELECT * 
			FROM gc_trash_temp
			INNER JOIN gc_category
			ON gc_trash_temp.trash_temp_fk_category = gc_category.cat_id
			INNER JOIN gc_uploads_img
			ON gc_uploads_img.uploads_id = gc_trash_temp.trash_temp_img
			INNER JOIN gc_town
			ON gc_town.town_id = gc_trash_temp.trash_temp_fk_town
			INNER JOIN gc_country
			ON gc_country.country_id = gc_trash_temp.trash_temp_fk_country
			LIMIT 10";
	
	//limiter le resultat aux 5 premiers résultat
	
	$reponse = mysqli_query($con,$sql_parti);
		
	echo "<form method=\"post\" action=\"cible.php\">";
	echo "<table border=\"1\">" ;
	echo "<td><strong><strong>To Accept</strong></strong></td>";
	echo "<td><strong><strong>To Delete</strong></strong></td>";
	echo "<td><strong>Image</strong></td>";
	echo "<td><strong>Id</strong></td>";
	echo "<td><strong>FK Country</strong></td>";
	echo "<td><strong>Date Time</strong></td>";
	echo "<td><strong>Latitude</strong></td>";
	echo "<td><strong>Longitude</strong></td>";
	echo "<td><strong>Address</strong></td>";
	echo "<td><strong>FK Town</strong></td>";
	echo "<td><strong>FK Country</strong></td>";
	echo "<td><strong>FK User</strong></td>";
	echo "<td><strong>Img Id</strong></td>";
	echo "<td><strong>Img url</strong></td>";
	
	$counter = 0 ;
	
	while($donnees = mysqli_fetch_array($reponse))
	{
		/*
		$radioButtonName = 'case'.$donnees['trash_temp_id'] ;
		$radioDel  = "del"+$donnees['trash_temp_id'] ;  //delete a trash
		$radioSave = "save"+$donnees['trash_temp_id'] ; // save a trash
		//*/
		//*
		$radioButtonName = 'case'.$counter ;
		$radioDel  = 'del'.$counter ;  //delete a trash
		$radioSave = 'save'.$counter ; // save a trash
		$id_trash = 'id_trash'.$counter ;
		$id_img   = 'id_img'.$counter ;
		$url_img  = 'url_img'.$counter ;
		//*/
		$del  = "del" ;
		$save = "save" ;
		echo "<tr>" ;
		echo "<td><input type=\"radio\" name=\"$radioButtonName\" id=\"$radioDel\" value=\"$save\" checked=\"checked\" /></td>" ;
		echo "<td><input type=\"radio\" name=\"$radioButtonName\" id=\"$radioSave\" value=\"$del\" /></td>" ;
		echo "<td>";
		echo "<p><img src=\"";
		echo $donnees['uploads_path'] ;
		echo "\" /></p>" ;
		echo "</td>";
		echo "<td>";
		echo "<input name=\"$id_trash\" type=\"text\" value=\"";
		echo $donnees['trash_temp_id'];
		echo "\" />" ;
		echo "</td>";
		echo "<td>";
		echo $donnees['cat_name'];
		echo "</td>";
		echo "<td>";
		echo $donnees['trash_temp_date_time']; 	
		echo "</td>";
		echo "<td>";
		echo $donnees['trash_temp_latitude'];
		echo "</td>";
		echo "<td>";
		echo $donnees['trash_temp_longitude']; 	
		echo "</td>";
		echo "<td>";
		echo $donnees['trash_temp_address']; 
		echo "</td>";
		echo "<td>";
		echo $donnees['town_name']; 	
		echo "</td>";
		echo "<td>";
		echo $donnees['country_name']; 
		echo "</td>";
		echo "<td>";
		echo $donnees['trash_temp_fk_user'];
		echo "</td>";
		echo "<td>";
		echo "<input name=\"$id_img\" type=\"text\" value=\"";
		echo $donnees['uploads_id']; 
		echo "\" />" ;
		echo "</td>";
		echo "<td>";
		echo "<input name=\"$url_img\" type=\"text\" value=\"";
		echo $donnees['uploads_path'];
		echo "\" />" ;
		echo "</td>";
		echo "</tr>" ;
		//uploads_path
		$counter = $counter + 1 ;
	}
	echo "</table>" ;
	echo "<input type=\"submit\" value=\"Envoyer le fichier\" />" ;
	echo "</form>" ;
	
	//$reponse->closeCursor(); // Termine le traitement de la requête
	?>