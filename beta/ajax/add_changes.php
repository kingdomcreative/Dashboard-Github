<?php

include ('../db.php');
include ('../functions.php');


	


      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		
		$film = $dbLink->real_escape_string($_POST['film']);
		$changeContent = $dbLink->real_escape_string($_POST['changesContent']);
		$projectTitle = $dbLink->real_escape_string($_POST['projectTitle']);
		$staffID = $_POST['staffID'];
		$projectID = $_POST['projectID'];
		
		
		
	
	
		$dbFilmAddQuery = sprintf(
			'INSERT INTO project_changes (
_kf_project_CHANGES,
_kf_staff_CHANGES,
_added_CHANGES,
film_CHANGES,
content_CHANGES) VALUES
(%d,"%d","%s","%s","%s")',$projectID,$staffID,currDateTime(),$film,$changeContent);
			
				
		$dbResultAddFilm = $dbLink->query($dbFilmAddQuery);
		
		
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for new change entry');
			
		
			
	//Send success message
		
   
	$message = $projectTitle.' has changes added';
		$link =   '/project/'.$projectID.'/'.titleURL($projectTitle).'/changes';
    	sendNewsAlert($message,$link);
    	

		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		
		die;
	}


  $dbLink->close;
  
  header("Location: /project/".$projectID."/".titleURL($projectTitle)."/changes");

?>