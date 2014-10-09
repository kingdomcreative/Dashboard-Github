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
		$filmTitle = $dbLink->real_escape_string($_GET['film_title']);
		$type = $_GET['type'];
		
		$filmData = fetchFilm($filmID);
		
		
		if(empty($filmData->folder_PROJECT)) {
		$videodir = '../video/'.$filmData->folder_CLIENT.'/'; } else {
			
		$videodir = '../video/'.$filmData->folder_CLIENT.'/'.$filmData->folder_PROJECT.'/';	
		}
		
		
		
		switch($type) {
			
		case "QT":
		unlink($videodir.$filmData->link_QT_VIDEO);
		$dbFilmDeleteQuery = sprintf('UPDATE video SET link_QT_VIDEO = NULL WHERE _kp_VIDEO = "%d"',$filmID);
		break;
		
		case "WMV":
		unlink($videodir.$filmData->link_WMV_VIDEO);
		$dbFilmDeleteQuery = sprintf('UPDATE video SET link_WMV_VIDEO = NULL WHERE _kp_VIDEO = "%d"',$filmID);
		break;
		
		case "FLV":
		unlink($videodir.$filmData->link_FLV_VIDEO);
		$dbFilmDeleteQuery = sprintf('UPDATE video SET link_FLV_VIDEO = NULL WHERE _kp_VIDEO = "%d"',$filmID);
		break;
		
		case "Other":
		unlink($videodir.$filmData->link_other_VIDEO);
		$dbFilmDeleteQuery = sprintf('UPDATE video SET link_other_VIDEO = NULL WHERE _kp_VIDEO = "%d"',$filmID);
		break;
			
		}
	

	
				
		$dbResultDeleteFilm = $dbLink->query($dbFilmDeleteQuery);
			
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when removing film link from database');
		

		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		
		die;
	}


  $dbLink->close;
  
  header("Location: /film/".$filmID."/".$filmTitle);

?>