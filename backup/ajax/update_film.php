<?php

include ('../db.php');
include ('../functions.php');

      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
		$filmID = $_POST['filmID'];
		$filmTitle = $dbLink->real_escape_string($_POST['filmTitle']);
		
		$path = parse_url($dbLink->real_escape_string($_POST['vimeoID']), PHP_URL_PATH);
		$pathComponents = explode("/", trim($path, "/")); 
        $vimeoID = $pathComponents[0];
		
		if(!empty($_FILES['qt_file']['name'])) {
		$linkQT = $dbLink->real_escape_string($_FILES['qt_file']['name']); } else { 
		$linkQT = $dbLink->real_escape_string($_POST['curr_qt_file']);
		}
		
		if(!empty($_FILES['wmv_file']['name'])) {
		$linkWMV = $dbLink->real_escape_string($_FILES['wmv_file']['name']); } else { 
		$linkWMV = $dbLink->real_escape_string($_POST['curr_wmv_file']);
		}
		
		if(!empty($_FILES['flv_file']['name'])) {
		$linkFLV = $dbLink->real_escape_string($_FILES['flv_file']['name']); } else { 
		$linkFLV = $dbLink->real_escape_string($_POST['curr_flv_file']);
		}


		if(!empty($_FILES['other_file']['name'])) {
		$linkOther = $dbLink->real_escape_string($_FILES['other_file']['name']); } else { 
		$linkOther = $dbLink->real_escape_string($_POST['curr_other_file']);
		}
		
		$linkOtherLabel = $dbLink->real_escape_string($_POST['other_file_label']);
		
		$youtubeID = $dbLink->real_escape_string($_POST['youtubeID']);
		
		
	//Check if record needs to go enable YouTube stats
		
		if (empty($_POST['youtubeStats'])) {
				$dbFilmUpdateQuery = sprintf(
			'UPDATE video SET 
title_VIDEO ="%s",
vimeoID_VIDEO = "%s",
link_QT_VIDEO = "%s",
link_WMV_VIDEO = "%s",
link_FLV_VIDEO = "%s",
link_other_VIDEO = "%s",
link_otherLabel_VIDEO = "%s",
youtubeStats_VIDEO = NULL WHERE _kp_VIDEO = "%d"',$filmTitle,$vimeoID,$linkQT,$linkWMV,$linkFLV,$linkOther,$linkOtherLabel,$filmID);
	
		} else {
			$dbFilmUpdateQuery = sprintf(
			'UPDATE video SET 
title_VIDEO ="%s",
vimeoID_VIDEO = "%s",
link_QT_VIDEO = "%s",
link_WMV_VIDEO = "%s",
link_FLV_VIDEO = "%s",
link_other_VIDEO = "%s",
link_otherLabel_VIDEO = "%s",
youtubeID_VIDEO = "%s",
youtubeStats_VIDEO = 1 WHERE _kp_VIDEO = "%d"',$filmTitle,$vimeoID,$linkQT,$linkWMV,$linkFLV,$linkOther,$linkOtherLabel,$youtubeID,$filmID);
		}
				
		$dbResultUpdateFilm = $dbLink->query($dbFilmUpdateQuery);
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when adding to database for film data');
				

		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
	}


  $dbLink->close;

?>