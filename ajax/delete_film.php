<?php

include ('../db.php');
include ('../functions.php');

      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		$filmID = $_GET['film'];
		$projectID = $_GET['project'];
		$projectTitle = $_GET['project_title'];
	
		$dbFilmDeleteQuery = sprintf('DELETE FROM video WHERE _kp_VIDEO = "%d"',$filmID);
	
				
		$dbResultDeleteFilm = $dbLink->query($dbFilmDeleteQuery);
		
		$deleted = mysqli_affected_rows($dbLink);
		
		
		if(!$deleted) {
		
		throw new Exception('Error removing film record - does not exist');
			
		}
		
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when removing film from database');
		

		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		
		die;
	}


  $dbLink->close;
  
  header("Location: /project/".$projectID."/".$projectTitle);

?>