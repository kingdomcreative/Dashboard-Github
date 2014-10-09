<?php

include ('../db.php');
include ('../functions.php');

      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		
		$staffID = $_POST['staffID'];
		
		$newsContent = $dbLink->real_escape_string($_POST['newsContent']);

		
		
		//Query to add news
		
		$dbNewsQuery = sprintf(
			'INSERT INTO staff_news (content_NEWS,_kf_staff_NEWS,_added_NEWS) VALUES ("%s","%d",NOW())',$newsContent,$staffID);
		
		$dbResultNews = $dbLink->query($dbNewsQuery);
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to news feed');
		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		die;
	}
	
	
	$dbLink->close;
	
	//Get staff details
	
	$staffDetail = fetchStaffviaID($staffID);

/*   Then send an email */

  
  $mailMessage = sprintf('<html>
		<body align="left" style="font-family:Arial, Helvetica, sans-serif;width:970px;">
        <img src="http://circuitpro.co.uk/client/images/cp_logo.jpg" width="277" height="71">
        <hr>
		<h3 style="font-family:Arial, Helvetica, sans-serif;color:#cc6600">INTERNAL NEWS FLASH</h3>
		<hr>
		<table width="400" border="0">
  <tr>
  	<td>From:</td>
  	<td>%s</td>
  	</tr>
  	
  	<tr>
  	<td>News:</td>
  	<td>%s</td>
  	</tr>
  	
</table>
		<p>Sign in to view:</p>
		<p><strong><a href="http://dashboard.circuitpro.co.uk" style="font-family:Arial, Helvetica, sans-serif;color:#cc6600;">Go to Dashboard</a></strong></p>
		<p>&nbsp;</p>
		<hr>
		</body>
</html>',$staffDetail->shortname_STAFF,$newsContent);

	$subject = sprintf('Circuit Pro - News Alert');
	
	
		$headers = 'From: '.SITE_SUPPORT_EMAIL.'' . "\n" .
	   'MIME-Version: 1.0' . "\n" .
	   'Content-type: text/html; charset=iso-8859-1' . "\n" .
	   'Reply-To: '. SITE_SUPPORT_EMAIL .'' . "\n" .
	   'Return-Path: '.SITE_SUPPORT_EMAIL.'' . "\n" .
	   'X-Mailer: PHP/' . phpversion();
	ini_set('sendmail_from', SITE_SUPPORT_EMAIL);
	
	mail('ben.treston@circuitpro.co.uk', $subject, $mailMessage, $headers);



  


?>