<?php

include ('../db.php');
include ('../functions.php');

      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		

		$projectID = $_GET['project'];

	
		$dbProjectDeleteQuery = sprintf('DELETE FROM project WHERE _kp_PROJECT = "%d"',$projectID);
	
				
		$dbResultDeleteProject = $dbLink->query($dbProjectDeleteQuery);
		
		$deleted = mysqli_affected_rows($dbLink);
		
		
		if(!$deleted) {
		
		throw new Exception('Error removing project record - does not exist');
			
		}
		
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when removing project from database');
		

		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		
		die;
	}


  $dbLink->close;
  
  header("Location: http://dashboard.circuitpro.co.uk");

?>