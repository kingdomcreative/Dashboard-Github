<?php

include ('../db.php');
include ('../functions.php');


      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		//Query to add news
		
		$dbFilmQuery = sprintf(
			'UPDATE video SET version_VIDEO=version_VIDEO+1 WHERE _kp_VIDEO = "%d"',$_GET['film']);
		
		$dbResultFilm = $dbLink->query($dbFilmQuery);
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when updating film version');
			
		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		die;
	}
	
	
	

printf('<a class="btn btn-success" href="#">VERSION UPDATED</a>');






?>