<?php

include ('../db.php');
include ('../functions.php');

      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		// Set video folder up - see if there a project folder
	
	
		if(empty($_POST['projectFolder'])) {
		$videodir = '../video/'.$dbLink->real_escape_string($_POST['clientFolder']).'/'; } else {
			
		$videodir = '../video/'.$dbLink->real_escape_string($_POST['clientFolder']).'/'.$dbLink->real_escape_string($_POST['projectFolder']).'/';	
		}
		
		
		$filmID = $_POST['filmID'];
		$filmTitle = $dbLink->real_escape_string($_POST['filmTitle']);
		$version = $_POST['version'];
		
		$prodMgrID = $_POST['prodMgrID'];
		$updatedBy = $dbLink->real_escape_string($_POST['updatedBy']);
		
		
		// Get Vimeo ID
		$path = parse_url($dbLink->real_escape_string($_POST['vimeoID']), PHP_URL_PATH);
		$pathComponents = explode("/", trim($path, "/")); 
        $vimeoID = $pathComponents[0];
        
        // Get YouTube ID
        if(strlen($_POST['youtubeID']) > 11) {
        //Get YouTube ID Out
		if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$dbLink->real_escape_string($_POST['youtubeID']), $match)) {
    $youtubeID = $match[1];
} } else { $youtubeID = $dbLink->real_escape_string($_POST['youtubeID']); }



		//Quicktime File
		
		if(!empty($_FILES['qt_file']['name'])) {
		$linkQT = safeFilename($dbLink->real_escape_string($_FILES['qt_file']['name']));
		 
		move_uploaded_file($_FILES['qt_file']['tmp_name'], $videodir.$linkQT); 
		
		} else { 
		$linkQT = safeFilename($dbLink->real_escape_string($_POST['curr_qt_file']));
		}
		
		if(!empty($_FILES['wmv_file']['name'])) {
		$linkWMV = safeFilename($dbLink->real_escape_string($_FILES['wmv_file']['name'])); 
		
		move_uploaded_file($_FILES['wmv_file']['tmp_name'], $videodir.$linkWMV); 
		
		} else { 
		$linkWMV = $dbLink->real_escape_string($_POST['curr_wmv_file']);
		}
		
		if(!empty($_FILES['flv_file']['name'])) {
		$linkFLV = safeFilename($dbLink->real_escape_string($_FILES['flv_file']['name'])); 
		
		move_uploaded_file($_FILES['flv_file']['tmp_name'], $videodir.$linkFLV); 
		
		} else { 
		$linkFLV = $dbLink->real_escape_string($_POST['curr_flv_file']);
		}


		if(!empty($_FILES['other_file']['name'])) {
		$linkOther = safeFilename($dbLink->real_escape_string($_FILES['other_file']['name'])); 
		
		move_uploaded_file($_FILES['other_file']['tmp_name'], $videodir.$linkOther); 
		
		} else { 
		$linkOther = $dbLink->real_escape_string($_POST['curr_other_file']);
		}
		
		$linkOtherLabel = $dbLink->real_escape_string($_POST['other_file_label']);
		

		
		
		
		
	//Check if record needs to go enable YouTube stats
		
		if (empty($_POST['youtubeStats'])) {
				$dbFilmUpdateQuery = sprintf(
			'UPDATE video SET 
title_VIDEO ="%s",
version_VIDEO ="%d",
_added_VIDEO = "%s",
vimeoID_VIDEO = "%s",
youtubeID_VIDEO = "%s",
link_QT_VIDEO = "%s",
link_WMV_VIDEO = "%s",
link_FLV_VIDEO = "%s",
link_other_VIDEO = "%s",
link_otherLabel_VIDEO = "%s",
youtubeStats_VIDEO = NULL WHERE _kp_VIDEO = "%d"',$filmTitle,$version,currDateTime(),$vimeoID,$youtubeID,$linkQT,$linkWMV,$linkFLV,$linkOther,$linkOtherLabel,$filmID);
	
		} else {
			$dbFilmUpdateQuery = sprintf(
			'UPDATE video SET 
title_VIDEO ="%s",
version_VIDEO ="%d",
_added_VIDEO = "%s",
vimeoID_VIDEO = "%s",
link_QT_VIDEO = "%s",
link_WMV_VIDEO = "%s",
link_FLV_VIDEO = "%s",
link_other_VIDEO = "%s",
link_otherLabel_VIDEO = "%s",
youtubeID_VIDEO = "%s",
youtubeStats_VIDEO = 1 WHERE _kp_VIDEO = "%d"',$filmTitle,$version,currDateTime(),$vimeoID,$linkQT,$linkWMV,$linkFLV,$linkOther,$linkOtherLabel,$youtubeID,$filmID);
		}
				
		$dbResultUpdateFilm = $dbLink->query($dbFilmUpdateQuery);
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for film data');
			
	
    	
    	//Send E-mail to Production Manager


    	$link =   '/film/'.$filmID.'/'.titleURL($filmTitle);
    	$prodMgr = fetchStaffviaID($prodMgrID);
    	$fullLink = 'http://dashboard.kingdom-creative.co.uk'.$link;

		$sendTo = UPDATE_FILM_NOTIFY.','.$prodMgr->email_STAFF;
		
    	$mailMessage = sprintf('<html>
		<body align="left" style="font-family:Arial, Helvetica, sans-serif;width:970px;">
        <img src="http://kingdom-creative.co.uk/wp-content/uploads/2014/04/kingdom-full-dark.png" width="277" height="71">
        <hr>
		<h3 style="font-family:Arial, Helvetica, sans-serif;color:#fb5a5a">%s added</h3>
		<hr>
		<table width="400" border="0">
 
   	<tr>
  	<td>View:&nbsp;&nbsp;</td>
  	<td><a href="%s">%s</a></td>
  	</tr>
 
  	<tr>
  	<td>Updated by:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>
  	
  	<tr>
  	<td>Version:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>
  	
  	<tr>
  	<td>Quicktime File:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>
  	
  	<tr>
  	<td>WMV File:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>
  	
  	<tr>
  	<td>FLV File:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>
  	
  	<tr>
  	<td>Other (%s) File:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>
  	
</table>
		<p><strong><a href="http://dev.kingdom-creative.co.uk" style="font-family:Arial, Helvetica, sans-serif;color:#fb5a5a;">Go to Dashboard</a></strong></p>
		<p>&nbsp;</p>
		<hr>
		</body>
</html>',$filmTitle,$fullLink,$filmTitle,$updatedBy,$version,$linkQT,$linkWMV,$linkFLV,$linkOtherLabel,$linkOther);

	$subject = sprintf('Dashboard - %s Film updated',$filmTitle);
	
	
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
		include('error.php');
	}


  $dbLink->close;
  

  
  header("Location: /film/".$filmID."/".titleURL($filmTitle));

?>