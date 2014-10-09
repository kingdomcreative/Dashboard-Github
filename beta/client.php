<?php 

include ('db.php');
include ('functions.php');

//Check if user is logged in first
	if (!checkStaffLoggedIn()) {
	header("Location: http://dashboard.kingdom-creative.co.uk"); }
	
	//Then fetch the staff record from cookie or session variable
	if(isset($_COOKIE['staff-ID'])) {
	$staffData = fetchStaffviaID($_COOKIE['staff-ID']); } else {
	$staffData = fetchStaffviaID($_SESSION['staff-ID']);
	}
	
	//See if variables have been passed through

	if(empty($_GET['id'])) {
	header("Location: /home");	
		
	}
	
	$clientData = fetchClientData('_kp_CLIENT',$_GET['id']);

	$localPage= $clientData->name_CLIENT;
	
	$folder = $clientData->folder_CLIENT;
	
	$dir = 'video/'.$folder;


?>

<!doctype html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body> 

  <?php include('includes/header.php'); ?> 

    
<div class="menu-header">
	<div class="container">

        <div class="span8 first">
		<h1>VIEW <span style="font-weight: 200;"><?php echo $clientData->name_CLIENT; ?></span></h1>
        </div>

        <div class="span4 staff">
        <img src="http://dashboard.circuitpro.co.uk/img/meet-<?php echo $staffData->username_STAFF; ?>.png">
        </div>

	</div>
</div>



  <! FILM BLOCK !>
<div class="fold-full">
<div class="container fold-dash">
	    <div class="row">

<! Breadcrumbs !>

<div class="span8">
        <ul class="breadcrumb">
        <li class="active"><a href="/client/<?php echo $clientData->_kp_CLIENT; ?>/<?php echo $clientData->username_CLIENT; ?>"><?php echo $clientData->name_CLIENT; ?></a> <span class="divider">/</span></li>
        </ul>
      </div>

<div class="span4 edit">

<div id="updateFilmVersion">
  <a class="btn btn-primary edit-toggle" href="#" id="editFilm">EDIT</a><a class="btn btn-success" href="mailto:?Subject=New Content: <?php echo $videoData->title_VIDEO; ?> updated to Version <?php echo $videoData->version_VIDEO+1; ?>" id="updateVersion" data-film="<?php echo $videoData->_kp_VIDEO; ?>">SAVE</a>
</div>

</div>
<! END Breadcrumbs !>
<div class="clearboth"></div>

<!-- ------------------------------- -->

<! CLIENT IMAGE !>


<div class="span2 news-item">
<?php if(!empty($clientData->image_CLIENT)) { ?>
<img src="http://dashboard.circuitpro.co.uk/img/client-<?php echo $clientData->image_CLIENT; ?>.jpg"><?php } ?>
</div>

<! END CLIENT IMAGE !>

<div class="span10 news-item">
<div class="client-details">
  <p>Username</p>
         <input type="text" value="<?php echo $clientData->username_CLIENT; ?>" class="share-links-input">
  <p>Password</p>
         <input type="text" value="<?php echo $clientData->password_CLIENT; ?>" class="share-links-input" >

  <p>Folder</p>
         <input type="text" value="/<?php echo $clientData->folder_CLIENT; ?>" class="share-links-input" >
        </div>
</div>

<p>&nbsp;</p>
<div class="clearboth"></div>

<div class="span12 news-item">
<ul class="single-list-clients">
	<li>
            <div class="file-label table-top-dark">FOLDER CONTENTS</div>
            <div class="file-label-input table-top-dark">FOLDER LOCATIONS</div>
            </li>

  
   <?php   
 
  
		chdir($dir); 
		array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files); 
		foreach($files as $filename) 
		{ 
    		$fullPath = 'http://content.kingdom-creative.co.uk/'.$folder.'/'.rawurlencode($filename);
			
			printf('
		<li><div class="file-label dark">%s&nbsp;</div><div class="file-label-input"><input type="text" value="%s" size="150" onClick="SelectAll(\'%d\');" id="%d" class="link-input"></div></li>',$filename,$fullPath,$element,$element);
		
		$element++;  
		}  ?>

  
 </ul> 
  
  
        </div>
</div>


<!-- ------------------------------- -->


  </div>
  </div>
  </div> 
  <! END FILM BLOCK !>
  
  






</body>

</html>
		
