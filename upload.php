<?php
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
	 $image = $_POST['image'];
	 $name  = $_POST['name'];
	 
	 require_once('dbConnect.php');
	 
	 $sql_parti ="SELECT uploads_id FROM gc_uploads_img ORDER BY uploads_id ASC";
	 $res = mysqli_query($con,$sql_parti);
	 $id = 0;
	 
	 while($row = mysqli_fetch_array($res)){
	 	$id = $row['uploads_id'];
	 }
	 
	 $path       = "pics/$id.png";
	 //$actualpath = "http://192.168.0.12/GarbageCollector/$path";
     $actualpath = "http://www.valhatech.com/trashcollector/$path";
	 
	 $sql_parti        = "INSERT INTO gc_uploads_img (uploads_path,uploads_name) VALUES ('$actualpath','$name')";
	 
	 if(mysqli_query($con,$sql_parti)){
		 file_put_contents($path,base64_decode($image));
		 echo "Successfully Uploaded";
	 }
	 
	 mysqli_close($con);
 }else{
 	echo "Error";
 }