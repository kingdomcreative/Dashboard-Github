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
		$clientFolder = $dbLink->real_escape_string($_POST['clientFolder']);
		$clientFolder = safeFileName($clientFolder);
		
		
	
			$dbClientAddQuery = sprintf(
			'INSERT INTO client (name_CLIENT,username_CLIENT,password_CLIENT,folder_CLIENT) VALUES ("%s","%s","%s","%s")',$clientName,$clientUsername,$clientPassword,$clientFolder);
		
				
		$dbResultAddClient = $dbLink->query($dbClientAddQuery);
		
		$client_added =  $dbLink->insert_id;	
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for client data');
			
		//Create the Client Folder
		
		$clientDirectory = '../video/'.$clientFolder;
		
		if(!mkdir($clientDirectory,0777,true)) { throw new Exception('An error occurred when creating project folder'); }
			
			
		$message = $clientName.' has been added as a client';
		$link =   '/client/'.$client_added.'/'.titleURL($clientUsername);
    	sendNewsAlert($message,$link);
		
      }
      	catch(Exception $thisException)
	{
		include('../error.php');
	}
	
	header("Location: /client/".$client_added."/".titleURL($clientUsername));


?>