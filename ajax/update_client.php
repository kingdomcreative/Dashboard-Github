<?php

include ('../db.php');
include ('../functions.php');

      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		$clientName = $dbLink->real_escape_string($_POST['clientName']);
		$clientUsername = $dbLink->real_escape_string($_POST['clientUsername']);
		$clientUsername = titleURL($clientUsername);
		$clientUsername = str_replace('_', '-', $clientUsername);
		$clientPassword = $dbLink->real_escape_string($_POST['clientPassword']);
		$clientID = $_POST['clientID'];

		
		
		
	
			$dbClientAddQuery = sprintf('UPDATE client SET name_CLIENT = "%s", username_CLIENT = "%s",password_CLIENT = "%s" WHERE _kp_CLIENT = %d',$clientName,$clientUsername,$clientPassword,$clientID);
		
				
		$dbResultAddClient = $dbLink->query($dbClientAddQuery);
		
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for client data');
			
		
      }
      	catch(Exception $thisException)
	{
		include('../error.php');
	}
	
	header("Location: /client/".$clientID."/".titleURL($clientUsername));


?>