<?php

include ('../db.php');
include ('../functions.php');

      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		
		$projectID = $_POST['projectID'];
		if(!empty($_POST['live'])) { $liveProject = 1; } else { $liveProject = 0; };
		if(!empty($_POST['youtubeStats'])) { $youTubeStatsProject = 1; } else { $youTubeStatsProject = 0; };

		$projTitle = $dbLink->real_escape_string($_POST['projTitle']);
		$projBrief1 = $dbLink->real_escape_string($_POST['brief1']);
		$projBrief2 = $dbLink->real_escape_string($_POST['brief2']);
		$projBrief3 = $dbLink->real_escape_string($_POST['brief3']);
		$projBrief4 = $dbLink->real_escape_string($_POST['brief4']);
		$projBrief5 = $dbLink->real_escape_string($_POST['brief5']);
		$projBrief6 = $dbLink->real_escape_string($_POST['brief6']);
		$projBrief7 = $dbLink->real_escape_string($_POST['brief7']);
		$projBrief8 = $dbLink->real_escape_string($_POST['brief8']);
		$projBrief9 = $dbLink->real_escape_string($_POST['brief9']);
		$projBrief10 = $dbLink->real_escape_string($_POST['brief10']);
		
		$date_filming = $_POST['date_filming'];
		$date_firstDelivery = $_POST['date_firstDelivery'];
		$date_approval = $_POST['date_approval'];
		$date_finalDelivery = $_POST['date_finalDelivery'];
		$date_brief = $_POST['date_brief'];
		
		$prodMgrID = $_POST['prodMgr'];
		$creativeMgr = $_POST['creativeMgr'];
		$editor = $_POST['editor'];
		
		$notes_int = $dbLink->real_escape_string($_POST['notes_int']);
		$client_approval = $dbLink->real_escape_string($_POST['client_approval']);
		
		$initial_planning = $_POST['hours_planning'];
		$initial_filming = $_POST['hours_filming'];
		$initial_editing = $_POST['hours_editing'];
		$initial_graphics = $_POST['hours_graphics'];
		$initial_changes = $_POST['hours_changes'];
		// $initial_delivery = $_POST['hours_delivery'];
		
		if(isset($_POST['completed'])) { $status = "Completed"; 
		
		
		//Query to update project - completed
		
	$dbProjectUpdateQuery = sprintf(
			'UPDATE project SET 
			title_PROJECT = "%s",
			live_PROJECT = "%d",
			brief1_aims_PROJECT = "%s",
			brief2_audience_PROJECT = "%s",
			brief3_broadcast_PROJECT = "%s",
			brief4_keypoints_PROJECT = "%s",
			brief5_duration_PROJECT = "%s",
			brief6_style_PROJECT = "%s",
			brief7_examples_PROJECT = "%s",
			brief8_campaign_PROJECT = "%s",
			brief9_graphics_PROJECT = "%s",
			brief10_success_PROJECT = "%s",
			date_filming_PROJECT = "%s",
			date_firstDelivery_PROJECT = "%s",
			date_approval_PROJECT = "%s",
			date_finalDelivery_PROJECT = "%s",
			brief_clientApproval_PROJECT = "%s",
			_kf_staff_prodManager_PROJECT = "%d",
			_kf_staff_creativeManager_PROJECT = "%d",
			_kf_staff_editor_PROJECT = "%d",
			_completed_brief_PROJECT = "%s",
			notes_int_PROJECT = "%s",
			youtubeStats_PROJECT = "%d",
			status_PROJECT = "%s",
			hours_initial_planning_PROJECT = "%f",
			hours_initial_filming_PROJECT = "%f",
			hours_initial_editing_PROJECT = "%f",
			hours_initial_graphics_PROJECT = "%f",
			hours_initial_changes_PROJECT = "%f",
			_completed_PROJECT = DATE(NOW())  
			WHERE _kp_PROJECT = "%d"',
			
			$projTitle,
			$liveProject,
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
			$client_approval,
			$prodMgrID,
			$creativeMgr,
			$editor,
			$date_brief,
			$notes_int,
			$youTubeStatsProject,
			$status,
			$initial_planning,
			$initial_filming,
			$initial_editing,
			$initial_graphics,
			$initial_changes,
			$projectID
	);
		
		
		} else { $status = "Active";
		
		//Query to update project
		
	$dbProjectUpdateQuery = sprintf(
			'UPDATE project SET 
			title_PROJECT = "%s",
			live_PROJECT = "%d",
			brief1_aims_PROJECT = "%s",
			brief2_audience_PROJECT = "%s",
			brief3_broadcast_PROJECT = "%s",
			brief4_keypoints_PROJECT = "%s",
			brief5_duration_PROJECT = "%s",
			brief6_style_PROJECT = "%s",
			brief7_examples_PROJECT = "%s",
			brief8_campaign_PROJECT = "%s",
			brief9_graphics_PROJECT = "%s",
			brief10_success_PROJECT = "%s",
			date_filming_PROJECT = "%s",
			date_firstDelivery_PROJECT = "%s",
			date_approval_PROJECT = "%s",
			date_finalDelivery_PROJECT = "%s",
			brief_clientApproval_PROJECT = "%s",
			_kf_staff_prodManager_PROJECT = "%d",
			_kf_staff_creativeManager_PROJECT = "%d",
			_kf_staff_editor_PROJECT = "%d",
			_completed_brief_PROJECT = "%s",
			notes_int_PROJECT = "%s",
			youtubeStats_PROJECT = "%d",
			status_PROJECT = "%s",
			hours_initial_planning_PROJECT = "%f",
			hours_initial_filming_PROJECT = "%f",
			hours_initial_editing_PROJECT = "%f",
			hours_initial_graphics_PROJECT = "%f",
			hours_initial_changes_PROJECT = "%f"   
			WHERE _kp_PROJECT = "%d"',
			
			$projTitle,
			$liveProject,
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
			$client_approval,
			$prodMgrID,
			$creativeMgr,
			$editor,
			$date_brief,
			$notes_int,
			$youTubeStatsProject,
			$status,
			$initial_planning,
			$initial_filming,
			$initial_editing,
			$initial_graphics,
			$initial_changes,
			$projectID
	);
		
		
		
		 }	
		
	
	
				
		$dbResultUpdateProject = $dbLink->query($dbProjectUpdateQuery);
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when updating database for project data');
			
		//Send success message
		
		if($status == "Completed") {
    	$message = $projTitle.' has been completed!'; } else {
	    	
	   $message = $projTitle.' has been updated';	
    	}
    	
		$link =   '/project/'.$projectID.'/'.titleURL($projTitle);
    	sendNewsAlert($message,$link);
    	
    	
        //Send E-mail to Post Production Manager
        
        $prodMgr = fetchStaffviaID($prodMgrID);

		$sendTo = UPDATE_PROJECT_NOTIFY.','.$prodMgr->email_STAFF;

    	$fullLink = 'http://dev.circuitpro.co.uk'.$link;


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
		<p><strong><a href="http://dev.kingdom-creative.co.uk" style="font-family:Arial, Helvetica, sans-serif;color:#fb5a5a;">Go to Dashboard</a></strong></p>
		<p>&nbsp;</p>
		<hr>
		</body>
</html>',$projTitle,$fullLink,$projTitle);

	$subject = sprintf('Dashboard - %s Project Updated',$projTitle);
	
	
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
		die;
	}


  header("Location: /project/".$projectID."/".titleURL($projTitle));

?>