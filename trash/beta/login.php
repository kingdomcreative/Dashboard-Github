<?php

session_start();

include ('db.php');
include ('functions.php');
    
      try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database.');
		
      $dbStaffQuery = sprintf(
			'SELECT * FROM staff WHERE username_STAFF = "%s" AND password_STAFF = "%s"', 
			$dbLink->real_escape_string($_POST['username']),
			$dbLink->real_escape_string($_POST['password'])
		);
				
		$dbResultStaff = $dbLink->query($dbStaffQuery);
		
		//Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when querying the database for Staff access');
		
		//User details not found in DB	
		   if( $dbResultStaff->num_rows != 1 )
			throw new Exception('Your username or password were not recognised, please try again.');
		
			
		
		//Get the Staff record out and chuck it into some session vars	
		  $staffDetail = $dbResultStaff->fetch_object();
		  
		 //Create a session cookie if requested
		if (isset($_POST['remember'])) {
	
		setcookie('staff-ID', $staffDetail->_kp_STAFF, time() + (86400 * 14)); } else {
	    
		$_SESSION['staff-ID'] = $staffDetail->_kp_STAFF;
		$_SESSION['staff-username'] = $staffDetail->username_STAFF;
        $_SESSION['staff-password'] = $staffDetail->password_STAFF;
        
        }
                
        $dbResultStaff->close();
		$dbLink->close();
		
		//See if we need to drop them at previous page
		
		if (isset($_SESSION['returnPage'])) {
		
		header("Location: ".$_SESSION['returnPage']);
		
		} else {
	
		header("Location: /home"); }
	
		
      }
      	catch(Exception $thisException)
	{
		include('error.php');
		die;
	}
        
        

?>