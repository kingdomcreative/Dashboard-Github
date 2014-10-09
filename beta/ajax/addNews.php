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
			'INSERT INTO staff_news (content_NEWS,_kf_staff_NEWS,_added_NEWS) VALUES ("%s","%d","%s")',$newsContent,$staffID,currDateTime());
		
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
	
	$emailList = fetchStaffEmails();

/*   Then send an email */

while($currentEmail = $emailList->fetch_object()) {

  
  $mailMessage = sprintf('<html>
		<body align="left" style="font-family:Arial, Helvetica, sans-serif;width:970px;">
        <img src="http://kingdom-creative.co.uk/wp-content/uploads/2014/04/kingdom-full-dark.png" width="277" height="71">
        <hr>
		<h3 style="font-family:Arial, Helvetica, sans-serif;color:#333">INTERNAL NEWS FLASH</h3>
		<hr>
		<table width="500" border="0">
  <tr>
  	<td>Posted by:&nbsp;&nbsp;%s</td>
  	<td>&nbsp;</td>
  	</tr>
  	
  	<tr>
  	<td>&nbsp;</td>
  	<td>&nbsp;</td>
  	</tr>
  	
  	<tr>
  	<td colspan="2">%s</td>
  	</tr>
  	
</table>
		<p>Sign in to view:</p>
		<p><strong><a href="http://dashboard.kingdom-creative.co.uk" style="font-family:Arial, Helvetica, sans-serif;color:#333;">Go to Dashboard</a></strong></p>
		<p>&nbsp;</p>
		<hr>
		</body>
</html>',$staffDetail->shortname_STAFF,stripcslashes($newsContent));

	$subject = sprintf('Kingdom Newsflash!');
	
	
		$headers = 'From: '.SITE_SUPPORT_EMAIL.'' . "\n" .
	   'MIME-Version: 1.0' . "\n" .
	   'Content-type: text/html; charset=iso-8859-1' . "\n" .
	   'Reply-To: '. SITE_SUPPORT_EMAIL .'' . "\n" .
	   'Return-Path: '.SITE_SUPPORT_EMAIL.'' . "\n" .
	   'X-Mailer: PHP/' . phpversion();
	ini_set('sendmail_from', SITE_SUPPORT_EMAIL);
	
	mail($currentEmail->email_STAFF, $subject, $mailMessage, $headers); }



  


?>