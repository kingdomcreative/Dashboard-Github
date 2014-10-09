<?php

include ('../functions.php');
include ('../db.php');

      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		$client = $_POST['clientID'];
		$added = $_POST['added'];
		$projTitle = $dbLink->real_escape_string($_POST['projTitle']);
		$projBrief1 = stripWordQuotes($dbLink->real_escape_string($_POST['brief1']));
		$projBrief2 = stripWordQuotes($dbLink->real_escape_string($_POST['brief2']));
		$projBrief3 = stripWordQuotes($dbLink->real_escape_string($_POST['brief3']));
		$projBrief4 = stripWordQuotes($dbLink->real_escape_string($_POST['brief4']));
		$projBrief5 = stripWordQuotes($dbLink->real_escape_string($_POST['brief5']));
		$projBrief6 = stripWordQuotes($dbLink->real_escape_string($_POST['brief6']));
		$projBrief7 = stripWordQuotes($dbLink->real_escape_string($_POST['brief7']));
		$projBrief8 = stripWordQuotes($dbLink->real_escape_string($_POST['brief8']));
		$projBrief9 = stripWordQuotes($dbLink->real_escape_string($_POST['brief9']));
		$projBrief10 = stripWordQuotes($dbLink->real_escape_string($_POST['brief10']));
		$briefContact = $dbLink->real_escape_string($_POST['approval_brief']);
		
		$date_filming = $_POST['date_filming'];
		$date_firstDelivery = $_POST['date_firstDelivery'];
		$date_approval = $_POST['date_approval'];
		$date_finalDelivery = $_POST['date_finalDelivery'];
		$date_brief = $_POST['date_brief'];
		
		
		$briefStaff = $_POST['brief_staff'];
		$prodMgrID = $_POST['prodMgr'];
		$creativeMgr = $_POST['creativeMgr'];
		$editor = $_POST['editor'];
		
		$notes_int = $dbLink->real_escape_string($_POST['notes_int']);
		
		$initial_planning = $_POST['hours_planning'];
		$initial_filming = $_POST['hours_filming'];
		$initial_editing = $_POST['hours_editing'];
		$initial_graphics = $_POST['hours_graphics'];
		$initial_changes = $_POST['hours_changes'];
		$initial_delivery = $_POST['hours_delivery'];
		
	//Check if project record needs to go live first up	
		if ($_POST['live'] == "live") {
		
		$dbProjectAddQuery = sprintf(
			'INSERT INTO project 
	(_kf_client_PROJECT,
	_added_PROJECT,
	title_PROJECT,
	live_PROJECT,
	brief1_aims_PROJECT,
	brief2_audience_PROJECT,
	brief3_broadcast_PROJECT,
	brief4_keypoints_PROJECT,
	brief5_duration_PROJECT,
	brief6_style_PROJECT,
	brief7_examples_PROJECT,
	brief8_campaign_PROJECT,
	brief9_graphics_PROJECT,
	brief10_success_PROJECT,
	date_filming_PROJECT,
	date_firstDelivery_PROJECT,
	date_approval_PROJECT,
	date_finalDelivery_PROJECT,
	_kf_staff_prodManager_PROJECT,
	_kf_staff_creativeManager_PROJECT,
	_kf_staff_editor_PROJECT,
	status_PROJECT,
	notes_int_PROJECT,
	brief_clientApproval_PROJECT,
	_kf_staff_brief_PROJECT,
	_completed_brief_PROJECT,
	hours_initial_planning_PROJECT,
	hours_initial_filming_PROJECT,
	hours_initial_editing_PROJECT,
	hours_initial_graphics_PROJECT,
	hours_initial_changes_PROJECT,
	hours_initial_delivery_PROJECT)
	 VALUES (%d,"%s","%s",1,"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s",%d,%d,%d,"Active","%s","%s",%d,"%s","%f","%f","%f","%f","%f","%f")',
	 $client,
	 $added,
	 $projTitle,
	 $projBrief1,
	 $projBrief2,
	 $projBrief3,
	 $projBrief4,
	 $projBrief5,
	 $projBrief6,
	 $projBrief7,
	 $projBrief8,
	 $projBrief9,
	 $projBrief10,
	 $date_filming,
	 $date_firstDelivery,
	 $date_approval,
	 $date_finalDelivery,
	 $prodMgrID,
	 $creativeMgr,
	 $editor,
	 $notes_int,
	 $briefContact,
	 $briefStaff,
	 $date_brief,
	 $initial_planning,
	 $initial_filming,
	 $initial_editing,
	 $initial_graphics,
	 $initial_changes,
	 $initial_delivery);
	
		} else {
					
		$dbProjectAddQuery = sprintf(
			'INSERT INTO project 
	(_kf_client_PROJECT,
	_added_PROJECT,
	title_PROJECT,
	brief1_aims_PROJECT,
	brief2_audience_PROJECT,
	brief3_broadcast_PROJECT,
	brief4_keypoints_PROJECT,
	brief5_duration_PROJECT,
	brief6_style_PROJECT,
	brief7_examples_PROJECT,
	brief8_campaign_PROJECT,
	brief9_graphics_PROJECT,
	brief10_success_PROJECT,
	date_filming_PROJECT,
	date_firstDelivery_PROJECT,
	date_approval_PROJECT,
	date_finalDelivery_PROJECT,
	_kf_staff_prodManager_PROJECT,
	_kf_staff_creativeManager_PROJECT,
	_kf_staff_editor_PROJECT,
	status_PROJECT,
	notes_int_PROJECT,
	brief_clientApproval_PROJECT,
	_kf_staff_brief_PROJECT,
	_completed_brief_PROJECT,
	hours_initial_planning_PROJECT,
	hours_initial_filming_PROJECT,
	hours_initial_editing_PROJECT,
	hours_initial_graphics_PROJECT,
	hours_initial_changes_PROJECT,
	hours_initial_delivery_PROJECT)
	 VALUES (%d,"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s",%d,%d,%d,"Active","%s","%s",%d,"%s","%f","%f","%f","%f","%f","%f")',
	 $client,
	 $added,
	 $projTitle,
	 $projBrief1,
	 $projBrief2,
	 $projBrief3,
	 $projBrief4,
	 $projBrief5,
	 $projBrief6,
	 $projBrief7,
	 $projBrief8,
	 $projBrief9,
	 $projBrief10,
	 $date_filming,
	 $date_firstDelivery,
	 $date_approval,
	 $date_finalDelivery,
	 $prodMgrID,
	 $creativeMgr,
	 $editor,
	 $notes_int,
	 $briefContact,
	 $briefStaff,
	 $date_brief,
	 $initial_planning,
	 $initial_filming,
	 $initial_editing,
	 $initial_graphics,
	 $initial_changes,
	 $initial_delivery);
	}		
				
		$dbResultAddProject = $dbLink->query($dbProjectAddQuery);
		
		
		
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for project data');
			
		$project_added =  $dbLink->insert_id;
		
		//Set up tasks for this project
		
		$dbProjectAddTasksQuery = sprintf('INSERT INTO project_tasks (_kf_project_TASKS) VALUES ("%d")',$project_added);
		$dbResultAddProjectTasks = $dbLink->query($dbProjectAddTasksQuery);
		
		
		//Create Folder for project 
		
		$folder = projectFolderString($project_added,$projTitle);
		$clientData = fetchClientData('_kp_CLIENT', $client);
		
		$projectDirectory = '../video/'.$clientData->folder_CLIENT.'/'.$folder;
		
		if(!mkdir($projectDirectory,0777,true)) { throw new Exception('An error occurred when creating project folder'); }
		
		//Add project folder to database
		
		$dbProjectAddFolderQuery = sprintf('UPDATE project SET folder_PROJECT = "%s" WHERE _kp_PROJECT = %d',$folder,$project_added);
		$dbResultAddProjectFolder = $dbLink->query($dbProjectAddFolderQuery);

			
	//Send success message
		
   
		$message = $projTitle.' project has been added';
		$link =   '/project/'.$project_added.'/'.titleURL($projTitle);
    	sendNewsAlert($message,$link);
    	
    	
        //Send E-mail to Post Production Manager

    	$fullLink = 'http://dashboard.circuitpro.co.uk'.$link;

		$prodMgr = fetchStaffviaID($prodMgrID);

		$sendTo = NEW_PROJECT_NOTIFY.','.$prodMgr->email_STAFF;
		
    	$mailMessage = sprintf('<html>
		<body align="left" style="font-family:Arial, Helvetica, sans-serif;width:970px;">
        <img src="http://kingdom-creative.co.uk/wp-content/uploads/2014/04/kingdom-full-dark.png" width="277" height="71">
        <hr>
		<h3 style="font-family:Arial, Helvetica, sans-serif;color:#fb5a5a">%s Project added</h3>
		<hr>
		<table width="400" border="0">

  	
  	<tr>
  	<td>View:&nbsp;&nbsp;</td>
  	<td><a href="%s">%s</a></td>
  	</tr>
  	
</table>
		<p><strong><a href="http://dashboard.kingdom-creative.co.uk" style="font-family:Arial, Helvetica, sans-serif;color:#fb5a5a;">Go to Dashboard</a></strong></p>
		<p>&nbsp;</p>
		<hr>
		</body>
</html>',$projTitle,$fullLink,$projTitle);

	$subject = sprintf('Dashboard - %s Project added',$projTitle);
	
	
		$headers = 'From: '.SITE_SUPPORT_EMAIL.'' . "\n" .
	   'MIME-Version: 1.0' . "\n" .
	   'Content-type: text/html; charset=iso-8859-1' . "\n" .
	   'Reply-To: '. SITE_SUPPORT_EMAIL .'' . "\n" .
	   'Return-Path: '.SITE_SUPPORT_EMAIL.'' . "\n" .
	   'X-Mailer: PHP/' . phpversion();
	ini_set('sendmail_from', SITE_SUPPORT_EMAIL);
	
	mail($sendTo, $subject, $mailMessage, $headers);

    	
		
      }
      	catch(Exception $thisException)
	{
		include('../error.php');
	}
	

	$dbLink->close();
	
	header("Location: /project/".$project_added."/".titleURL($projTitle));

?>

