<?php 

//----------------- !ERROR REPORTING AND DEBUG -------------------------//


/*

 error_reporting(E_ALL);
 ini_set('display_errors', '1');

*/


//--------------------- !STAFF AND SESSION FUNCTIONS --------------------//

	if(!session_id()) {
     session_start();
     }
     
     ini_set('date.timezone','Europe/London');
     

function currentPageURL() {
 	$pageURL = 'http';
 	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
    || $_SERVER['SERVER_PORT'] == 443) {$pageURL .= "s";}
 	$pageURL .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") {
  	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} else {
  	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 	return $pageURL;
}
	

function checkStaffLoggedIn () {
	
	if ( isset($_SESSION['staff-ID']) || isset($_COOKIE['staff-ID'])) {
	
	return true; } else { return false; }
		
}
	
	
function fetchStaffNews() {
		 try {
		//Create link
		$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
			
		//Can't connect to DB
		if( mysqli_connect_errno() )
			throw new Exception('Could not connect to database (function: fetchStaffNews).');
			
	      $dbNewsQuery = 'SELECT *, DATE_FORMAT(_added_NEWS, "%e %b %Y - %k:%i") AS added_NEWS FROM staff_news LEFT JOIN staff ON staff_news._kf_staff_NEWS = staff._kp_STAFF ORDER BY _added_NEWS DESC LIMIT 10';
					
			$dbNewsResult = $dbLink->query($dbNewsQuery);
			
			//General Query error
			if( $dbLink->errno )
				throw new Exception('An error occurred when querying the database for user data');
			
				
			return $dbNewsResult;
				
			
	      }
	      	catch(Exception $thisException)
			{
			include('error.php'); 
			die;
			
			} 
			
			$dbNewsResult->close();
				$dbLink->close();
		
}


function sendNewsAlert($message,$link) {
		 try {
		//Create link
		$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
			
		//Can't connect to DB
		if( mysqli_connect_errno() )
			throw new Exception('Could not connect to database (function: sendNewsAlert).');
			
			if(!empty($link)) { $newsContent = sprintf('<a href="%s">%s</a>',$link,$message); } else { $newsContent = $message; }
			
	      $dbNewsQuery = sprintf(
			'INSERT INTO staff_news (content_NEWS,_kf_staff_NEWS,_added_NEWS) VALUES (\'%s\',\'%d\',\'%s\')',$newsContent,11,currDateTime());
					
			$dbNewsResult = $dbLink->query($dbNewsQuery);
			
			//General Query error
			if( $dbLink->errno )
				throw new Exception('An error occurred when sending news alert');
			
			return true;	
			
	      }
	      	catch(Exception $thisException)
			{
			include('error.php'); 
			die;
			
			} 
			
			$dbNewsResult->close();
				$dbLink->close();
		
}

function fetchStaffEmails() {
		 try {
		//Create link
		$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
			
		//Can't connect to DB
		if( mysqli_connect_errno() )
			throw new Exception('Could not connect to database (function: fetchStaffEmails).');
			
			
	      $dbStaffQuery = sprintf(
			'select email_STAFF from staff WHERE mailingList_STAFF = 1');
					
			$dbStaffResult = $dbLink->query($dbStaffQuery);
			
			//General Query error
			if( $dbLink->errno )
				throw new Exception('An error occurred when fetching staff emails');
			
			return $dbStaffResult;	
			
	      }
	      	catch(Exception $thisException)
			{
			include('error.php'); 
			die;
			
			} 
			
			$dbStaffResult->close();
				$dbLink->close();
		
}
	


function fetchStaffviaID($value) {
			
			if(! $value) { return "Not Assigned";  die;}
			
			 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect to DB
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database (function: fetchStaffRecord).');
				
		      $dbStaffQuery = sprintf(
					'SELECT * FROM staff WHERE _kp_STAFF = %d',$dbLink->real_escape_string($value));
						
				$dbStaffResult = $dbLink->query($dbStaffQuery);
				
				//General Query error
				if( $dbLink->errno )
					throw new Exception('An error occurred when querying the database for staff data');
				
				//User details not found in DB	
				   if( $dbStaffResult->num_rows == 0 )
						return false;
					
				return $dbStaffResult->fetch_object();
					
				
		      }
		      	catch(Exception $thisException)
				{
				include('error.php'); 
				die;
				
				} 
				
				$dbStaffResult->close();
				$dbLink->close();
				
}
		

function fetchStaffviaType($type,$current) {
	
	 try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect to DB
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database (function: fetchStaffviaType).');
		
	if($type == "ALL") {
		
		
		$dbStaffQuery = sprintf('SELECT * FROM staff WHERE _kp_STAFF <> 11');
	} else {
		
      $dbStaffQuery = sprintf(
			'SELECT * FROM staff WHERE type_STAFF LIKE "%%%s%%" AND _kp_STAFF <> "%d"',$dbLink->real_escape_string($type),$current); }
				
		$dbStaffResult = $dbLink->query($dbStaffQuery);
		
		//General Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when querying the database for staff data');
		
		//User details not found in DB	
		   if( $dbStaffResult->num_rows == 0 )
				return false;
			
		return $dbStaffResult;
			
		
      }
      	catch(Exception $thisException)
		{
		include('error.php'); 
		die;
		
		} 
		
		$dbStaffResult->close();
			$dbLink->close();
		
}

//----------------------- PROJECT FUNCTIONS -------------------------------//


function fetchAllActiveProjects($show) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
		
			if($show == "all") {
			$dbProjectQuery = 'SELECT SQL_CALC_FOUND_ROWS *, DATE_FORMAT(_added_PROJECT, "%e %b %Y") AS added_PROJECT, DATE_FORMAT(date_firstDelivery_PROJECT, "%e %b %Y") AS firstDelivery_PROJECT, DATE_FORMAT(date_approval_PROJECT, "%e %b %Y") AS approval_PROJECT, DATE_FORMAT(date_finalDelivery_PROJECT, "%e %b %Y") AS finalDelivery_PROJECT, (hours_initial_planning_PROJECT + hours_initial_filming_PROJECT + hours_initial_editing_PROJECT + hours_initial_graphics_PROJECT + hours_initial_changes_PROJECT + hours_initial_delivery_PROJECT) AS total_initial, (hours_planning_PROJECT + hours_filming_PROJECT + hours_editing_PROJECT + hours_graphics_PROJECT + hours_changes_PROJECT + hours_delivery_PROJECT) AS total_current FROM project LEFT JOIN client ON project._kf_client_PROJECT = client._kp_CLIENT LEFT JOIN video ON project._kp_PROJECT = video._kf_project_VIDEO WHERE status_PROJECT = "Active" OR status_PROJECT = "Approved" GROUP BY project._kp_PROJECT ORDER BY video._added_VIDEO DESC'; }
			else {
			$dbProjectQuery ='SELECT SQL_CALC_FOUND_ROWS *, DATE_FORMAT(_added_PROJECT, "%e %b %Y") AS added_PROJECT, DATE_FORMAT(date_firstDelivery_PROJECT, "%e %b %Y") AS firstDelivery_PROJECT, DATE_FORMAT(date_approval_PROJECT, "%e %b %Y") AS approval_PROJECT, DATE_FORMAT(date_finalDelivery_PROJECT, "%e %b %Y") AS finalDelivery_PROJECT, (hours_initial_planning_PROJECT + hours_initial_filming_PROJECT + hours_initial_editing_PROJECT + hours_initial_graphics_PROJECT + hours_initial_changes_PROJECT + hours_initial_delivery_PROJECT) AS total_initial, (hours_planning_PROJECT + hours_filming_PROJECT + hours_editing_PROJECT + hours_graphics_PROJECT + hours_changes_PROJECT + hours_delivery_PROJECT) AS total_current FROM project LEFT JOIN client ON project._kf_client_PROJECT = client._kp_CLIENT LEFT JOIN video ON project._kp_PROJECT = video._kf_project_VIDEO WHERE (_kf_staff_prodManager_PROJECT = "'.$show.'" OR _kf_staff_creativeManager_PROJECT = "'.$show.'" OR _kf_staff_editor_PROJECT = "'.$show.'") AND status_PROJECT = "Active" OR status_PROJECT = "Approved" GROUP BY project._kp_PROJECT ORDER BY video._added_VIDEO DESC'; }
				
				
				$dbResultProject = $dbLink->query($dbProjectQuery);
				
				
				return $dbResultProject;
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
			
			$dbResultProject->close();
			$dbLink->close();
}

function fetchAllCompletedProjects($page,$limit) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
				
				if(empty($page)) { $page = 0; $limit = PROJECT_RESULTS_PER_PAGE; }
		
			$dbProjectQuery = 'SELECT SQL_CALC_FOUND_ROWS *, DATE_FORMAT(_added_PROJECT, "%e %b %Y") AS added_PROJECT, DATE_FORMAT(date_firstDelivery_PROJECT, "%e %b %Y") AS firstDelivery_PROJECT, DATE_FORMAT(date_approval_PROJECT, "%e %b %Y") AS approval_PROJECT, DATE_FORMAT(date_finalDelivery_PROJECT, "%e %b %Y") AS finalDelivery_PROJECT FROM project LEFT JOIN client ON project._kf_client_PROJECT = client._kp_CLIENT WHERE live_PROJECT IS NOT NULL AND status_PROJECT = "Completed" ORDER BY _added_PROJECT DESC LIMIT '.$page.','.$limit;
				
				
				$dbResultProject = $dbLink->query($dbProjectQuery);
				
				$project_found =  $dbLink->query('SELECT FOUND_ROWS() AS found')->fetch_object()->found;		   
				
				return $dbResultProject;
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}

function fetchProject($projectID) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
				
				if(empty($page)) { $page = 0; $limit = PROJECT_RESULTS_PER_PAGE; }
		
			$dbProjectQuery = 'SELECT *, DATE_FORMAT(_added_PROJECT, "%e %b %Y") AS added_PROJECT, DATE_FORMAT(date_firstDelivery_PROJECT, "%e %b %Y") AS firstDelivery_PROJECT, DATE_FORMAT(date_approval_PROJECT, "%e %b %Y") AS approval_PROJECT, DATE_FORMAT(date_finalDelivery_PROJECT, "%e %b %Y") AS finalDelivery_PROJECT FROM project LEFT JOIN client ON project._kf_client_PROJECT = client._kp_CLIENT WHERE _kp_PROJECT = "'.$projectID.'"';
				
				
				$dbResultProject = $dbLink->query($dbProjectQuery);

				
				return $dbResultProject->fetch_object();
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}




function fetchAllProjectChanges($projectID) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
				
						
			$dbProjectQuery = 'SELECT SQL_CALC_FOUND_ROWS *, DATE_FORMAT(_added_CHANGES, "%e %b %Y") AS added_CHANGES FROM project_changes LEFT JOIN staff ON project_changes._kf_staff_CHANGES = staff._kp_STAFF WHERE _kf_project_CHANGES = "'.$projectID.'" ORDER BY _added_CHANGES DESC';
				
				
				$dbResultProject = $dbLink->query($dbProjectQuery);
				
				$changes_found =  $dbLink->query('SELECT FOUND_ROWS() AS found')->fetch_object()->found;		   
				
				return $dbResultProject;
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}


function fetchProjectHoursByType($projectID,$type) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
				
			if($type == "all") {
			$dbProjectQuery = 'SELECT SUM(amount_HOURS) AS hoursTypeTotal_HOURS FROM project_hours WHERE _kf_project_HOURS = "'.$projectID.'"';	
			}	else {		
			$dbProjectQuery = 'SELECT SUM(amount_HOURS) AS hoursTypeTotal_HOURS FROM project_hours WHERE _kf_project_HOURS = "'.$projectID.'" AND type_HOURS = "'.$type.'"'; }
				
				
				$dbResultProject = $dbLink->query($dbProjectQuery);	   
				
				return $dbResultProject->fetch_object()->hoursTypeTotal_HOURS;
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}

function fetchProjectTasksProduction($projectID) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
				
						
			$dbProjectQuery = 'SELECT *, DATE_FORMAT(_added_TASKS, "%e %b %Y") AS added_TASKS FROM project_tasks WHERE _kf_project_TASKS = "'.$projectID.'"';
				
				
				$dbResultProjectTasks = $dbLink->query($dbProjectQuery);
				  
				
				return $dbResultProjectTasks->fetch_object();
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}


function fetchProjectTaskCompletion($projectID) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
				
						
			$dbProjectQuery = 'SELECT ifnull(item1_TASKS, 0) + ifnull(item2_TASKS, 0) + ifnull(item3_TASKS, 0) + ifnull(item4_TASKS, 0) + ifnull(item5_TASKS, 0) + ifnull(item6_TASKS, 0) + ifnull(item7_TASKS, 0) + ifnull(item8_TASKS, 0) + ifnull(item9_TASKS, 0) + ifnull(item10_TASKS, 0) + ifnull(item11_TASKS, 0) + ifnull(item12_TASKS, 0) + ifnull(item13_TASKS, 0) + ifnull(item14_TASKS, 0) + ifnull(item15_TASKS, 0) + ifnull(item16_TASKS, 0) + ifnull(item17_TASKS, 0) + ifnull(item18_TASKS, 0) + ifnull(item19_TASKS, 0) + ifnull(item20_TASKS, 0) + ifnull(item21_TASKS, 0) + ifnull(item22_TASKS, 0) AS completion_TASKS FROM project_tasks WHERE _kf_project_TASKS = "'.$projectID.'"';
				
				
				$dbResultProjectCompletion = $dbLink->query($dbProjectQuery);
				  
				
				return $dbResultProjectCompletion->fetch_object();
				
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}


//----------------------- FILM FUNCTIONS -------------------------------//

function fetchFilm($filmID) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
		
			$dbFilmQuery = 'SELECT *, DATE_FORMAT(_added_VIDEO, "%e %b %Y") AS added_VIDEO,title_PROJECT from video LEFT JOIN project ON video._kf_project_VIDEO = project._kp_PROJECT LEFT JOIN client ON project._kf_client_PROJECT = client._kp_CLIENT WHERE _kp_VIDEO ="'.$filmID.'"';
			$dbFilmResult = $dbLink->query($dbFilmQuery);
			
			$films_found =  $dbLink->query('SELECT FOUND_ROWS() AS found')->fetch_object()->found;

			return $dbFilmResult->fetch_object();
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}

function fetchRelatedFilms($projectID,$currfilmID) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
		
			if(empty($currfilmID)){
			$dbFilmQuery = 'SELECT *, DATE_FORMAT(_added_VIDEO, "%e %b %Y") AS added_VIDEO,title_PROJECT from video LEFT JOIN project ON video._kf_project_VIDEO = project._kp_PROJECT LEFT JOIN client ON project._kf_client_PROJECT = client._kp_CLIENT WHERE _kp_PROJECT ="'.$projectID.'" ORDER BY _added_VIDEO DESC'; } else {
			
			$dbFilmQuery = 'SELECT *, DATE_FORMAT(_added_VIDEO, "%e %b %Y") AS added_VIDEO,title_PROJECT from video LEFT JOIN project ON video._kf_project_VIDEO = project._kp_PROJECT LEFT JOIN client ON project._kf_client_PROJECT = client._kp_CLIENT WHERE _kp_PROJECT ="'.$projectID.'" AND _kp_VIDEO <> "'.$currfilmID.'" ORDER BY _added_VIDEO DESC';
				
			}
			
			$dbFilmResult = $dbLink->query($dbFilmQuery);
			
			//No related films	
			   if( $dbFilmResult->num_rows == 0 )
					return false;

			return $dbFilmResult;
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}

function fetchLatestFilm() {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
				
		
			$dbFilmQuery = 'SELECT * FROM video ORDER BY _added_VIDEO DESC LIMIT 1';
				
				
				$dbResultFilm = $dbLink->query($dbFilmQuery);	   
				
				return $dbResultFilm->fetch_object();
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}


function updateYoutubeViewCount($filmID,$views) {
	
	try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect to DB
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database (updateYoutubeViewCount).');
		
      $dbYTQuery = sprintf(
			'UPDATE video SET youtubeViews_VIDEO = "%d" WHERE _kp_VIDEO = "%d"',$views,$filmID);
				
		$dbYTResult = $dbLink->query($dbYTQuery);
		
		//General Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when updating youtube view count');
			
		return true;
		
      }
      	catch(Exception $thisException)
		{
		include('error.php'); 
		
		die;
		
		} 
		
		$dbYTResult->close();
			$dbLink->close();
	
	
}

function searchFilms($string,$page,$limit) {

		 try {
			//Create link
			$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
				
			//Can't connect
			if( mysqli_connect_errno() )
				throw new Exception('Could not connect to database.');
				
			if(empty($page)) { $page = 0; $limit = PROJECT_RESULTS_PER_PAGE; }
		
			$dbSearchQuery = 'SELECT *, DATE_FORMAT(_added_VIDEO, "%e %b %Y") AS added_VIDEO,title_PROJECT from video LEFT JOIN project ON video._kf_project_VIDEO = project._kp_PROJECT WHERE (title_VIDEO LIKE "%'.$dbLink->real_escape_string($string).'%" OR title_PROJECT LIKE "%'.$dbLink->real_escape_string($string).'%")  ORDER BY _added_VIDEO DESC LIMIT '.$page.','.$limit;
			
			$dbSearchResult = $dbLink->query($dbSearchQuery);
			
			$films_found =  $dbLink->query('SELECT FOUND_ROWS() AS found')->fetch_object()->found;
			
			if( $films_found == 0 ) {
			   
				return false; };
				
			return $dbSearchResult;
				
		      }
		      	catch(Exception $thisException)
			{
				include('error.php');
				die;
			}
}



function fetchSearchCount($string) {
	 try {
	//Create link
	$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
		
	//Can't connect to DB
	if( mysqli_connect_errno() )
		throw new Exception('Could not connect to database (fetchStoryCount).');
		
		

		$dbSearchQuery = 'SELECT *, DATE_FORMAT(_added_VIDEO, "%e %b %Y") AS added_VIDEO,title_PROJECT from video LEFT JOIN project ON video._kf_project_VIDEO = project._kp_PROJECT WHERE (title_VIDEO LIKE "%'.$dbLink->real_escape_string($string).'%" OR title_PROJECT LIKE "%'.$dbLink->real_escape_string($string).'%")  ORDER BY _added_VIDEO DESC';
		
		
		$dbResultCount = $dbLink->query($dbSearchQuery);
		
		$searchFound = $dbLink->query('SELECT FOUND_ROWS() AS found')->fetch_object()->found;


		
		//General Query error
		if( $dbLink->errno )
			throw new Exception('An error occurred when querying the database for search content count');
		
		//User details not found in DB	
		   if( $searchFound == 0 ) {
			   
				return false; };
	
		return $searchFound;
		
      }
      	catch(Exception $thisException)
		{
	
		print($thisException->getMessage());
		
		} 
		
		$dbResultCount->close();
		$dbLink->close();
		
		}

//----------------------- CLIENT FUNCTIONS -------------------------------//

function fetchAllClients($sort) {
		 try {
		//Create link
		$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
			
		//Can't connect to DB
		if( mysqli_connect_errno() )
			throw new Exception('Could not connect to database (function: fetchUserRecord).');
			
		if($sort == "name") {	
	      $dbClientQuery = sprintf('SELECT * FROM client ORDER BY name_CLIENT'); }
	      else {
		   $dbClientQuery = sprintf('SELECT * FROM client ORDER BY lastlogin_CLIENT DESC');   
		      
	      }
					
			$dbClientResult = $dbLink->query($dbClientQuery);
			
			//General Query error
			if( $dbLink->errno )
				throw new Exception('An error occurred when querying the database for client data');
			
				
			return $dbClientResult;
				
			
	      }
	      	catch(Exception $thisException)
			{
			include('error.php'); 
			die;
			
			} 
			
			$dbClientResult->close();
			$dbLink->close();
		
}

function fetchClientData($field, $value) {
		 try {
		//Create link
		$dbLink = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
			
		//Can't connect to DB
		if( mysqli_connect_errno() )
			throw new Exception('Could not connect to database (function: fetchUserRecord).');
			
	      $dbClientQuery = sprintf(
				'SELECT * FROM client WHERE %s = "%s"',$field,$dbLink->real_escape_string($value));
					
			$dbClientResult = $dbLink->query($dbClientQuery);
			
			//General Query error
			if( $dbLink->errno )
				throw new Exception('An error occurred when querying the database for client data');
			
			//User details not found in DB	
			   if( $dbClientResult->num_rows == 0 )
					return false;
				
			return $dbClientResult->fetch_object();
				
			
	      }
	      	catch(Exception $thisException)
			{
			include('error.php'); 
			die;
			
			} 
			
			$dbClientResult->close();
				$dbLink->close();
		
}

/* ------------------------------ GENERAL FUNCTIONS ----------------------------------- */

function titleURL($text) {
	
	$text = strip_tags($text);
	$text = preg_replace("/[^a-zA-Z0-9\s\-]/", "", $text);
	$text = strtolower($text);
	$url_text = str_replace(" ","_",$text);
	$url_text = str_replace("__","_",$url_text);
	$url_text = trim($url_text, '_');
	
	return $url_text;
	
}


function projectFolderString($projectID,$title) {
	
	$title = strip_tags($title);
	$title = preg_replace("/[^a-zA-Z0-9\s\-]/", "", $title);
	$projTitle_text = str_replace(" ","_",$title);
	$projTitle_text = str_replace("__","_",$projTitle_text);
	$projTitle_text = trim($projTitle_text, '_');
	
	$folder = $projectID.'_'.$projTitle_text;
	
	return $folder;
	
}


function currDateTime(){
    return date("Y-m-d H:i:s", time()); }
    
    
    
function stripWordQuotes($string) {

		$search = array(chr(145),chr(146),chr(147),chr(148),chr(151),chr(149));
		
		$replace = array("'","'",'"','"','-','*');
		
		return str_replace($search, $replace, $string);
}



function createLinks($text){
    return preg_replace('*(f|ht)tps?://[A-Za-z0-9\./?=\+\-&_%]+*', '<a href="$0" target="_blank">$0</a>', $text);
}
		
	
/* ------------------------------ FILE DOWNLOAD FUNCTIONS ----------------------------------- */
		
function fileDownloadURL ($filename,$folder) {
	

	 $file_name = rawurlencode($filename);
	 $file_path = 'http://content.kingdom-creative.co.uk/'.$folder.'/'.$file_name;
	 
				
	return $file_path; }
	
	
function fileDownloadCheck ($path) {
		 
	 return (@fopen($path,"r")==true);
	 
	 }
	 


function safeFilename($string) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "â€”", "â€“", ",", "<", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = str_replace(" ","_",$clean);
    $clean = trim($clean, '_');
    return $clean;
}


		
?>