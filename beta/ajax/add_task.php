<?php

include ('../db.php');
include ('../functions.php');


      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		
		$task = $_GET['task'];
		$project = $_GET['project'];
		$addedBy = $dbLink->real_escape_string($_GET['addedBy']);
		$title =  $dbLink->real_escape_string($_GET['title']);
		$reload = 'http://dashboard.circuitpro.co.uk/project/'.$project.'/'.$title.''.'#tasks';


		if($_GET['uncheck'] =="yes") {
			
		$dbProjectAddTask = sprintf(
			'UPDATE project_tasks SET item%d_TASKS = NULL, _staff_TASKS = "%s", _added_TASKS = "%s" WHERE _kf_project_TASKS = "%d"',$task,$addedBy,currDateTime(),$project);
		} else {
		$dbProjectAddTask = sprintf(
			'UPDATE project_tasks SET item%d_TASKS = "1", _staff_TASKS = "%s", _added_TASKS = "%s" WHERE _kf_project_TASKS = "%d"',$task,$addedBy,currDateTime(),$project); }
			
				
		$dbResultAddTask = $dbLink->query($dbProjectAddTask);
		
		if($_GET['approve'] =="yes") {
			
		$dbProjectApprovedQuery = sprintf('UPDATE project SET status_PROJECT = "Approved" WHERE _kp_PROJECT = "%d"',$project); 			
				
		$dbProjectApproved = $dbLink->query($dbProjectApprovedQuery);
			
		}
		
		
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for new task entry');
		
		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		
		die;
	}


  $dbLink->close;
  
  header('Location: '.$reload);
  
 

?>