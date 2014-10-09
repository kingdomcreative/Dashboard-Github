
<p id="searchresults">
<?php
include '../db.php'; 
include '../functions.php';

	
   $db = new mysqli(DBHOST, DBUSER, DBPASS, DBASE);
   
   if(!$db) {
      // Show error if we cannot connect.
      echo 'ERROR: Could not connect to the database.';
   } else {
      // Is there a posted query string?
      if(isset($_POST['queryString'])) {
         $queryString = $db->real_escape_string($_POST['queryString']);
         
         // Is the string length greater than 0?
         if(strlen($queryString) >0) {
			 

            $filmQuery = $db->query('SELECT *, DATE_FORMAT(_added_VIDEO, "%e %b %Y") AS added_VIDEO,title_PROJECT from video LEFT JOIN project ON video._kf_project_VIDEO = project._kp_PROJECT WHERE (title_VIDEO LIKE "%'.$queryString.'%" OR title_PROJECT LIKE "%'.$queryString.'%")  ORDER BY _added_VIDEO DESC LIMIT 5');
			

            
			$filmFound =  $db->query('SELECT FOUND_ROWS() AS found')->fetch_object()->found;
			
			if($filmFound >= 1) {
				
				 echo '<span class="category">Found Films</span><ul>';
				
				 while ($filmResult = $filmQuery ->fetch_object()) {
					 
					 $urlString = titleURL($filmResult->title_VIDEO);
					 
					 printf ('<li><a href="/project/%d/%s">%s</a> - <a href="/film/%d/%s">%s</a></li>',$filmResult->_kp_PROJECT,titleURL($filmResult->title_PROJECT),$filmResult->title_PROJECT,$filmResult->_kp_VIDEO,$urlString,$filmResult->title_VIDEO);
                     
                     echo '</span>';
                  }
				  
				
				
			}
			
			
         } else {
            // Dont do anything.
         } // There is a queryString.
      } else {
         echo 'There should be no direct access to this script!';
      }
	  
	    echo '<span class="seperator"><a href="sitemap/" title="Sitemap">Not found? View the Sitemap</a></span><br class="break" />';
	  
   }
   
    $filmQuery->close();
	$db->close();
?>
</p>
