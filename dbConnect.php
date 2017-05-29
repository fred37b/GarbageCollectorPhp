<?php		
	/**
	 * Mise a jour : 06/09/16
	 * 
	 * Permet de se connecter a la bdd, est appele par l'ensemble des scripts.
	 * 
	 */
	//Defining Constants
	define('HOST','<database_host>');
	define('USER','<database_user>');
	define('PASS','<password>');
	define('DB','<database_name>');
	
	//Connecting to Database
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');