<?php

include ('../db.php');
include ('../functions.php');


      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
	
		$project = $_POST['project'];
		$addedBy = $dbLink->real_escape_string($_POST['addedBy']);
		$title =  $dbLink->real_escape_string($_POST['title']);
		$notes =  $dbLink->real_escape_string($_POST['tasknotes']);
		$reload = 'http://dev.kingdom-creative.co.uk/project/'.$project.'/'.$title.''.'#tasks';



		$dbProjectTaskNotes = sprintf(
			'UPDATE project_tasks SET notes_TASKS = "%s" WHERE _kf_project_TASKS = "%d"',$notes,$project);
			
				
		$dbResultAddNotes = $dbLink->query($dbProjectTaskNotes);
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for new task entry');
		
		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		
		die;
	}
  
  echo $reload;
  
  header('Location: '.$reload);
  
 

?>