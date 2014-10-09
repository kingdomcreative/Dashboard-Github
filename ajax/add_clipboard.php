<?php

include ('../db.php');
include ('../functions.php');


	


      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		
		
	 $link = $dbLink->real_escape_string($_POST['link']);
	 $rawLink = $dbLink->real_escape_string($_POST['link']);
	 $notes = $dbLink->real_escape_string($_POST['notes']);
	 $title = $dbLink->real_escape_string($_POST['title']);
	 
	
	if(preg_match('/http:\/\/www\.youtube\.com\/watch\?v=[^&]+/', $link, $vresult)) {

		   //Get YouTube ID Out
		if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$link, $match)) {
			$youtubeID = $match[1]; }
         

      } elseif(preg_match('/https:\/\/vimeo\.com\/[0-9]+/', $link, $vresult)) {


          //Get Vimeo ID Out
          
          if (preg_match('/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',$link, $match)) {
			$vimeoID = $match[2]; }
          
          } else {
	          
	          $linkID = 'True';
	          
          }
	
	
	if(!empty($youtubeID)) 	
	$dbClipboardQuery = sprintf(
'INSERT INTO staff_clipboard (
_kf_staff_CLIPBOARD,
_date_CLIPBOARD,
title_CLIPBOARD,
category_CLIPBOARD,
notes_CLIPBOARD,
youtubeID_CLIPBOARD) VALUES
(%d,"%s","%s","%s","%s","%s")',$_POST['staff'],currDateTime(),$title,$_POST['category'],$notes,$youtubeID);

	if(!empty($vimeoID)) 	
	$dbClipboardQuery = sprintf(
'INSERT INTO staff_clipboard (
_kf_staff_CLIPBOARD,
_date_CLIPBOARD,
title_CLIPBOARD,
category_CLIPBOARD,
notes_CLIPBOARD,
vimeoID_CLIPBOARD) VALUES
(%d,"%s","%s","%s","%s","%s")',$_POST['staff'],currDateTime(),$title,$_POST['category'],$notes,$vimeoID);

	if(!empty($linkID)) 	
	$dbClipboardQuery = sprintf(
'INSERT INTO staff_clipboard (
_kf_staff_CLIPBOARD,
_date_CLIPBOARD,
title_CLIPBOARD,
category_CLIPBOARD,
notes_CLIPBOARD,
url_CLIPBOARD) VALUES
(%d,"%s","%s","%s","%s","%s")',$_POST['staff'],currDateTime(),$title,$_POST['category'],$notes,$link);


		$dbResultAddClipboard = $dbLink->query($dbClipboardQuery);
		
		
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for new clipboard entry');
			
		 $clipboard_added =  $dbLink->insert_id;	
		
	
	
		//Send success message to news feed
		
   
		$message = $title.' posted on clipboard';
		$link =   '/clipboard';
    	sendNewsAlert($message,$link);
    	
    	//Send E-mail to Everyone

		$emailList = fetchStaffEmails();
		
		while($currentEmail = $emailList->fetch_object()) {

    	$mailMessage = sprintf('<html>
		<body align="left" style="font-family:Arial, Helvetica, sans-serif;width:970px;">
        <img src="http://kingdom-creative.co.uk/wp-content/uploads/2014/04/kingdom-full-dark.png" width="277" height="71">
        <hr>
		<h3 style="font-family:Arial, Helvetica, sans-serif;color:#fb5a5a">"%s" posted to clipboard</h3>
		<hr>
		<table width="400" border="0">

  	<tr>
  	<td>View:&nbsp;&nbsp;</td>
  	<td><a href="%s">%s</a></td>
  	</tr>
  	
  	  	<tr>
  	<td>Notes:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>


  <tr>
  	<td>Added by:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>
  	
  	  <tr>
  	<td>In Category:&nbsp;&nbsp;</td>
  	<td>%s</td>
  	</tr>
  	

  	
</table>
		<p><strong><a href="http://dashboard.kingdom-creative.co.uk/clipboard" style="font-family:Arial, Helvetica, sans-serif;color:#fb5a5a;">Go to Dashboard</a></strong></p>
		<p>&nbsp;</p>
		<hr>
		</body>
</html>',$title,$rawLink,$title,$notes,$_POST['addedBy'],$_POST['category']);

	$subject = sprintf('Dashboard - %s added to clipboard',$title);
	
	
		$headers = 'From: '.SITE_SUPPORT_EMAIL.'' . "\n" .
	   'MIME-Version: 1.0' . "\n" .
	   'Content-type: text/html; charset=iso-8859-1' . "\n" .
	   'Reply-To: '. SITE_SUPPORT_EMAIL .'' . "\n" .
	   'Return-Path: '.SITE_SUPPORT_EMAIL.'' . "\n" .
	   'X-Mailer: PHP/' . phpversion();
	ini_set('sendmail_from', SITE_SUPPORT_EMAIL);
	
	mail($currentEmail->email_STAFF, $subject, $mailMessage, $headers);	}

		
      }
      	catch(Exception $thisException)
	{
		include('../error.php');
		
		die;
	}
	
	
	header("Location: /clipboard");



?>

