<?php

include ('../db.php');
include ('../functions.php');


	


      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		//Get Vimeo ID Out
		$path = parse_url($dbLink->real_escape_string($_POST['vimeoID']), PHP_URL_PATH);
		$pathComponents = explode("/", trim($path, "/"));
		$vimeoID = $pathComponents[0];
		
		
		        if(strlen($_POST['youtubeID']) > 11) {
        //Get YouTube ID Out
		if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$dbLink->real_escape_string($_POST['youtubeID']), $match)) {
    $youtubeID = $match[1];
} } else { $youtubeID = $dbLink->real_escape_string($_POST['youtubeID']); }
		
		$project = $_POST['projectID'];
		$prodMgrID = $_POST['prodMgrID'];
		$addedBy = $dbLink->real_escape_string($_POST['addedBy']);
		$filmTitle = $dbLink->real_escape_string($_POST['filmTitle']);
		$password = $dbLink->real_escape_string($_POST['vimeoPassword']);
		
		
	
	
		$dbFilmAddQuery = sprintf(
			'INSERT INTO video (
_kf_project_VIDEO,
_added_VIDEO,
title_VIDEO,
vimeoID_VIDEO,
password_VIDEO,
youtubeID_VIDEO) VALUES
(%d,"%s","%s","%s","%s","%s")',$project,currDateTime(),$filmTitle,$vimeoID,$password,$youtubeID);
			
				
		$dbResultAddFilm = $dbLink->query($dbFilmAddQuery);
		
		
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for new film entry');
			
		 $film_added =  $dbLink->insert_id;	
		
			
	//Send success message
		
   
	$message = $filmTitle.' film has been added';
		$link =   '/film/'.$film_added.'/'.titleURL($filmTitle);
    	sendNewsAlert($message,$link);
    	
    	//Send E-mail to Production Manager

    	$prodMgr = fetchStaffviaID($prodMgrID);
    	$fullLink = 'http://dashboard.circuitpro.co.uk'.$link;


    	$mailMessage = sprintf('<html>
		<body align="left" style="font-family:Arial, Helvetica, sans-serif;width:970px;">
        <img src="http://circuitpro.co.uk/client/images/cp_logo.jpg" width="277" height="71">
        <hr>
		<h3 style="font-family:Arial, Helvetica, sans-serif;color:#cc6600">%s added</h3>
		<hr>
		<table width="400" border="0">
  <tr>
  	<td>Added by:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>
  	
  	<tr>
  	<td>View:&nbsp;&nbsp;</td>
  	<td><a href="%s">%s</a></td>
  	</tr>
  	
</table>
		<p><strong><a href="http://dashboard.circuitpro.co.uk" style="font-family:Arial, Helvetica, sans-serif;color:#cc6600;">Go to Dashboard</a></strong></p>
		<p>&nbsp;</p>
		<hr>
		</body>
</html>',$filmTitle,$addedBy,$fullLink,$filmTitle);

	$subject = sprintf('Dashboard - %s Film added',$filmTitle);
	
	
		$headers = 'From: '.SITE_SUPPORT_EMAIL.'' . "\n" .
		'Cc: '.POST_PROD_EMAIL .'' . "\n" .
	   'MIME-Version: 1.0' . "\n" .
	   'Content-type: text/html; charset=iso-8859-1' . "\n" .
	   'Reply-To: '. SITE_SUPPORT_EMAIL .'' . "\n" .
	   'Return-Path: '.SITE_SUPPORT_EMAIL.'' . "\n" .
	   'X-Mailer: PHP/' . phpversion();
	ini_set('sendmail_from', SITE_SUPPORT_EMAIL);
	
	mail($prodMgr->email_STAFF, $subject, $mailMessage, $headers);
		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		
		die;
	}


  $dbLink->close;

?>