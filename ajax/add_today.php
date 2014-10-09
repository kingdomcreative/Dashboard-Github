<?php

include ('../db.php');
include ('../functions.php');

      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		// Set image folder up 
	
		$imageDir = '../today/images/';	
		
		
		$todayText = $dbLink->real_escape_string($_POST['todayText']);
		$staff = $_POST['staff'];
		

		//Image File
		
		if(!empty($_FILES['image']['name'])) {
		$linkImage = safeFilename($dbLink->real_escape_string($_FILES['image']['name']));
		 
		move_uploaded_file($_FILES['image']['tmp_name'], $imageDir.$linkImage); }
				
		
		
	//Check if record needs to go enable YouTube stats
		
	
		$dbTodayAddQuery = sprintf(
			'INSERT INTO today (
staff_TODAY,
_date_TODAY,
message_TODAY,image_TODAY) VALUES
("%s","%s","%s","%s")',$staff,currDateTime(),$todayText,$linkImage);
	
				
		$dbResultUpdateFilm = $dbLink->query($dbTodayAddQuery);
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for film data');
			
				

		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
	}


  $dbLink->close;
  

  
  header("Location: /home");

?>