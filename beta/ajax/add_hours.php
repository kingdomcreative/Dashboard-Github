<?php

include ('../db.php');
include ('../functions.php');


	


      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		
		$type = $_POST['hours_type'];
		$staffID = $_POST['staff'];
		$hours = number_format($_POST['hours_value'],2);
		$date = $_POST['hours_date'];
		$projectTitle = $dbLink->real_escape_string($_POST['projectTitle']);
		$projectID = $_POST['projectID'];
		
		switch ($type) {
			
			case "planning":
			$dbProjectAddHoursQuery1 = sprintf(
			'INSERT INTO project_hours (_kf_project_HOURS,_kf_staff_HOURS,_added_HOURS,amount_HOURS,type_HOURS) VALUES
("%d","%d","%s","%f","planning")',$projectID,$staffID,$date,$hours);
			$dbProjectAddHoursQuery2 = sprintf(
			'UPDATE project SET hours_planning_PROJECT = hours_planning_PROJECT + "%f" WHERE _kp_PROJECT = "%d"',$hours,$projectID);
			break;
			
			case "filming":
			$dbProjectAddHoursQuery1 = sprintf(
			'INSERT INTO project_hours (_kf_project_HOURS,_kf_staff_HOURS,_added_HOURS,amount_HOURS,type_HOURS) VALUES
("%d","%d","%s","%f","filming")',$projectID,$staffID,$date,$hours);
$dbProjectAddHoursQuery2 = sprintf(
			'UPDATE project SET hours_filming_PROJECT = hours_filming_PROJECT + "%f" WHERE _kp_PROJECT = "%d"',$hours,$projectID);
			break;
			
			case "editing":
			$dbProjectAddHoursQuery1 = sprintf(
			'INSERT INTO project_hours (_kf_project_HOURS,_kf_staff_HOURS,_added_HOURS,amount_HOURS,type_HOURS) VALUES
("%d","%d","%s","%f","editing")',$projectID,$staffID,$date,$hours);
$dbProjectAddHoursQuery2 = sprintf(
			'UPDATE project SET hours_editing_PROJECT = hours_editing_PROJECT + "%f" WHERE _kp_PROJECT = "%d"',$hours,$projectID);
			break;
			
			case "graphics":
			$dbProjectAddHoursQuery1 = sprintf(
			'INSERT INTO project_hours (_kf_project_HOURS,_kf_staff_HOURS,_added_HOURS,amount_HOURS,type_HOURS) VALUES
("%d","%d","%s","%f","graphics")',$projectID,$staffID,$date,$hours);
$dbProjectAddHoursQuery2 = sprintf(
			'UPDATE project SET hours_graphics_PROJECT = hours_graphics_PROJECT + "%f" WHERE _kp_PROJECT = "%d"',$hours,$projectID);
			break;
			
			case "changes":
			$dbProjectAddHoursQuery1 = sprintf(
			'INSERT INTO project_hours (_kf_project_HOURS,_kf_staff_HOURS,_added_HOURS,amount_HOURS,type_HOURS) VALUES
("%d","%d","%s","%f","changes")',$projectID,$staffID,$date,$hours);
$dbProjectAddHoursQuery2 = sprintf(
			'UPDATE project SET hours_changes_PROJECT = hours_changes_PROJECT + "%f" WHERE _kp_PROJECT = "%d"',$hours,$projectID);
			break;
			
			case "travel":
			$dbProjectAddHoursQuery1 = sprintf(
			'INSERT INTO project_hours (_kf_project_HOURS,_kf_staff_HOURS,_added_HOURS,amount_HOURS,type_HOURS) VALUES
("%d","%d","%s","%f","travel")',$projectID,$staffID,$date,$hours);
			break;

			
		/*	case "delivery":
			$dbProjectAddHoursQuery = sprintf(
			'INSERT INTO project_hours (_kf_project_HOURS,_kf_staff_HOURS,_added_HOURS,amount_HOURS,type_HOURS) VALUES
("%d","%d","%s","%f","delivery")',$projectID,$staffID,currDateTime(),$hours);
			break; */
			
		}
			
		$dbResultAddHours = $dbLink->query($dbProjectAddHoursQuery1);
		
		if($type != "travel"){
		$dbResultAddHoursTotal = $dbLink->query($dbProjectAddHoursQuery2); }
		
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for new hours entry');
			
				
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		
		die;
	}


  $dbLink->close;
  

  
 header("Location: /project/".$projectID."/".titleURL($projectTitle)."/report");

?>