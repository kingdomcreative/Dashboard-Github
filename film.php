<?php 

include ('db.php');
include ('functions.php');

//Check if user is logged in first
	if (!checkStaffLoggedIn()) {
	header("Location: http://dev.kingdom-creative.co.uk"); }
	
//Then fetch the staff record from cookie or session variable
	if(isset($_COOKIE['staff-ID'])) {
	$staffData = fetchStaffviaID($_COOKIE['staff-ID']); } else {
	$staffData = fetchStaffviaID($_SESSION['staff-ID']);
	}
	
//See if variables have been passed through

	if(empty($_GET['id'])) {
	header("Location: /home");	
		
	}
	
	$videoData = fetchFilm($_GET['id']);

	$localPage= $videoData->title_VIDEO;


?>

<!doctype html> 
<html lang="en">

<?php include('includes/head.php'); ?>


<script type="text/javascript" language="JavaScript1.2">


function confirmDeleteFilm(title)
{
	
var agree=confirm("Are you sure you wish to delete the film - " + title + " ?");
if (agree)
	return true ;
else
	return false ;
}


function confirmDeleteLink()
{
	
var agree=confirm("Are you sure you wish to delete the downloadable link ? This will also delete the file being linked to!");
if (agree)
	return true ;
else
	return false ;
}



</script>

<body>

  <?php include('includes/header.php'); ?> 
  
  <!-- /PROJECT TITLE --> 
  <div id="projectTitle">
<div class="row">
<div class="col-md-8">
<h2><?php echo $videoData->title_VIDEO; ?></h2>
</div>
<div class="col-md-4 align-right">
<a class="btn btn-primary-outline" href="#editFilm" id="editFilmButton" data-toggle="tab">Edit film</a>
<!-- <a class="btn btn-primary" href="#addFilm" id="addFilmButton" data-toggle="tab">Add film</a> -->
</div>
</div>
</div>
<!-- /PROJECT TITLE -->

<!-- BREADCRUMBS -->
<div id="breadcrumbsTitle" class="hidden-xs">
<i class="fa fa-tag"></i><a href="/client/<?php echo $videoData->_kp_CLIENT; ?>/<?php echo $videoData->username_CLIENT; ?>"><?php echo $videoData->name_CLIENT; ?></a> <i class="fa fa-angle-right"></i> <a href="/project/<?php echo $videoData->_kp_PROJECT; ?>/<?php echo titleURL($videoData->title_PROJECT); ?>"><?php echo $videoData->title_PROJECT; ?></a> <i class="fa fa-angle-right"></i> <a href="/film/<?php echo $videoData->_kp_VIDEO; ?>/<?php echo titleURL($videoData->title_VIDEO); ?>"><?php echo $videoData->title_VIDEO; ?></a> - Version: <?php echo $videoData->version_VIDEO; ?>
</div>
<!-- / BREADCRUMBS -->

  
  <div class="container" id="single-film">
      <!-- Example row of columns -->    
      <div class="row" id="film-full">
      
       <div class="col-xs-3 col-sm-2 col-md-1 film-tabs">
       <ul>
       <li class="active"><a href="#film" data-toggle="tab" data-toggle="tooltip" data-placement="right" title="Film"><i class="fa fa-film"></i></a></li>
       <li><a href="#editFilm" data-toggle="tab" data-toggle="tooltip" data-placement="right" title="Edit Film"><i class="fa fa-edit"></i></a></li>
       </ul>
       </div>


       <div class="tab-content">
      
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane active" id="film">
      <?php if($videoData->youtubeID_VIDEO) { ?>
      <iframe width="730" height="410" src="http://www.youtube.com/embed/<?php echo $videoData->youtubeID_VIDEO; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
      <?php } else { ?>
      <iframe width="730" height="410" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen src="http://player.vimeo.com/video/<?php echo $videoData->vimeoID_VIDEO?>?title=0&amp;byline=0&amp;portrait=0&amp;color=f28c3a"></iframe>
      <?php } ?>
      </div>
      
      
      <!-- EDIT FILM -->
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane" id="editFilm">
     <div class="wrap">
     
     <form class="form-horizontal" id="filmUpdate" method="post" action="/ajax/update_film.php" enctype="multipart/form-data" name="editFilmForm">
     
     <input type="hidden" value="<?php echo $videoData->_kp_VIDEO; ?>" name="filmID">
     <input type="hidden" value="<?php echo $videoData->folder_CLIENT; ?>" name="clientFolder">
     <input type="hidden" value="<?php echo $videoData->folder_PROJECT; ?>" name="projectFolder">
     <input type="hidden" value="<?php echo $staffData->shortname_STAFF; ?>" name="updatedBy">
     <input type="hidden" value="<?php echo $videoData->_kf_staff_prodManager_PROJECT; ?>" name="prodMgrID">

     <div class="row">
      <div class="col-md-12 col-lg-6">
      <h2>Edit <?php echo $videoData->title_VIDEO; ?></h2>
      </div>
      
      <div class="col-lg-6 align-right tight-right visible-lg">
      <?php if(!empty($videoData->viewingNotes_CLIENT)) { ?><div class="span12"><div class="alert"><i class="icon-bell"></i> CLIENT DELIVERY: <?php echo $videoData->viewingNotes_CLIENT; ?></div></div><?php } ?>
      <?php printf('<a class="btn btn-primary-outline" href="/ajax/delete_film.php?film=%d&project=%d&project_title=%s" id="deteleFilm" onClick="return confirmDeleteFilm(\'%s\')"><i class="fa fa-trash-o"></i></a>',$videoData->_kp_VIDEO,$videoData->_kp_PROJECT,titleURL($videoData->title_PROJECT),$videoData->title_VIDEO); ?> <input type="submit" class="btn btn-primary" value="Save">

      </div>
     </div>
     
      <div id="section-tabs" class="section-films">
      
      <h5 class="sub-title">General Information</h5>
      
      <div class="row">
      
      <div class="col-lg-6">
      <label>Film title</label>

      <input type="text" value="<?php echo $videoData->title_VIDEO; ?>" name="filmTitle" class="form-control">
      </div>
      
      <div class="col-md-4 col-lg-2">
      <label>Vimeo ID</label>
       <div class="input-group">
          <input type="text" value="<?php echo $videoData->vimeoID_VIDEO; ?>" onClick="SelectAll('form-vimeo');" id="form-vimeo" name="vimeoID" class="form-control">
          <?php if(!empty($videoData->vimeoID_VIDEO)) { ?><span class="input-group-addon">
<a href="https://vimeo.com/<?php echo $videoData->vimeoID_VIDEO; ?>/settings/file" target="_blank"><i class="fa fa-share-square fa-fw"></i></a></span><?php } ?>
        </div>
      </div>

      
      <div class="col-md-4 col-lg-2">
      <label>Youtube ID</label>
      <div class="input-group">
          <input type="text" value="<?php echo $videoData->youtubeID_VIDEO; ?>" onClick="SelectAll('form-youtube');" id="form-youtube" name="youtubeID" class="form-control">
          <?php if(!empty($videoData->youtubeID_VIDEO)) { ?><span class="input-group-addon"><a href="http://www.youtube.com/watch?v=<?php echo $videoData->youtubeID_VIDEO; ?>" target="_blank"><i class="fa fa-share-square fa-fw"></i></a></span><?php } ?>
        </div>
      </div>
      
       <div class="col-md-4 col-lg-2">
      <label>Version</label>
      <select name="version" class="form-control">
	      <?php $versionCounter = $videoData->version_VIDEO; while ($versionCounter <= 8) { printf('<option value ="%d">%d</option>',$versionCounter,$versionCounter); $versionCounter++; } ?>
	  </select>
      </div>
      
       
      <div class="clearboth"></div> 
      
      <div class="col-md-12"><hr></div>
            
            
       <div class="col-md-12 col-lg-8">
      <label>Quicktime Download</label>
      <div class="input-group">
      <input type="text" value="<?php echo $videoData->link_QT_VIDEO; ?>" class="form-control" name="curr_qt_file" readonly>
          <span class="input-group-addon"><?php if(!empty($videoData->link_QT_VIDEO))  printf('<a href="/ajax/delete_film_link.php?film=%d&film_title=%s&type=QT&clientFolder=%s" onClick="return confirmDeleteLink()"><i class="fa fa fa-trash-o fa-fw"></i></a>',$videoData->_kp_VIDEO,titleURL($videoData->title_VIDEO),$videoData->folder_CLIENT); ?></span>
        </div>
      </div>
      
      <div class="col-md-12 col-lg-4 update">
      <input type="file"  name="qt_file"> 
      </div>
      
      
      <div class="col-md-12"><hr></div>
      
      <div class="col-md-12 col-lg-8">
      <label>WMV Download</label>

      <div class="input-group">
      <input type="text" value="<?php echo $videoData->link_WMV_VIDEO; ?>" class="form-control" name="curr_wmv_file" readonly>       
      <span class="input-group-addon"><?php if(!empty($videoData->link_WMV_VIDEO))  printf('<a href="/ajax/delete_film_link.php?film=%d&film_title=%s&type=WMV&clientFolder=%s" onClick="return confirmDeleteLink()"><i class="fa fa fa-trash-o fa-fw"></i></a>',$videoData->_kp_VIDEO,titleURL($videoData->title_VIDEO),$videoData->folder_CLIENT); ?></span>
        </div>
      </div>
      
      <div class="col-md-12 col-lg-4 update">
      <input type="file" name="wmv_file">   
      </div>

      <div class="clearboth"></div>  
      
      <div class="col-md-12"><hr></div>
      
      <div class="col-md-12 col-lg-8">
      <label>FLV Download</label>

      <div class="input-group">
      <input type="text" value="<?php echo $videoData->link_FLV_VIDEO; ?>" class="form-control" name="curr_flv_file" readonly>
<span class="input-group-addon"><?php if(!empty($videoData->link_FLV_VIDEO))  printf('<a href="/ajax/delete_film_link.php?film=%d&film_title=%s&type=FLV&clientFolder=%s" onClick="return confirmDeleteLink()"><i class="fa fa fa-trash-o fa-fw"></i></a>',$videoData->_kp_VIDEO,titleURL($videoData->title_VIDEO),$videoData->folder_CLIENT); ?></span>
        </div>
      </div>
      
      <div class="col-md-12 col-lg-4 update">
      <input type="file" name="flv_file">
      </div>

        <div class="clearboth"></div>  
        
      <div class="col-md-12"><hr></div>
      
      <div class="col-md-12 col-lg-4">
      <label>Other Label</label>
      <input type="text" value="<?php echo $videoData->link_otherLabel_VIDEO; ?>" class="form-control" name="other_file_label">
      </div>
      
      <div class="col-md-12 col-lg-4">
      <label>Other Download</label>

      <div class="input-group">
      <input type="text" value="<?php echo $videoData->link_other_VIDEO; ?>" name="curr_other_file" class="form-control" readonly>
<span class="input-group-addon"><?php if(!empty($videoData->link_other_VIDEO))  printf('<a href="/ajax/delete_film_link.php?film=%d&film_title=%s&type=Other&clientFolder=%s" onClick="return confirmDeleteLink()"><i class="fa fa fa-trash-o fa-fw"></i></a>',$videoData->_kp_VIDEO,titleURL($videoData->title_VIDEO),$videoData->folder_CLIENT); ?></span>
        </div>
      </div>
      
      <div class="col-md-12 col-lg-4 update" >
      <input type="file" name="other_file">
      </div>

        <div class="clearboth"></div>  
        
         
      <div class="col-md-12"><hr></div>
        
      <div class="col-md-8">  
        <div class="checkbox">
    <label>
      <input type="checkbox"> YouTube live stats
    </label>
  </div>
  
      </div>
      
      
      <div class="col-md-12"><hr></div>
      
      <div class="col-md-12">  
      <?php printf('<a class="btn btn-primary-outline" href="/ajax/delete_film.php?film=%d&project=%d&project_title=%s" id="deteleFilm" onClick="return confirmDeleteFilm(\'%s\')"><i class="fa fa-trash-o"></i></a>',$videoData->_kp_VIDEO,$videoData->_kp_PROJECT,titleURL($videoData->title_PROJECT),$videoData->title_VIDEO); ?> <input type="submit" class="btn btn-primary" value="Save">
      
      </div>
      


      </div>
      
            </div>  
         
      </div> <!-- /WRAP -->
      


      </div>
      
     </form>

      
       </div> 
       
       <!-- /Tab Content -->
      
      
      <div class="col-md-4 downloads hidden-xs hidden-sm">
            
       <h2>Downloads</h2>
       
            
            <ul>
            
      <?php if($videoData->link_QT_VIDEO || $videoData->link_WMV_VIDEO || $videoData->link_FLV_VIDEO || $videoData->link_iPhone_VIDEO || $videoData->link_other_VIDEO) { ?>
      
      <form class="form-horizontal" name="viewFilmForm">


<!-- !FILE DOWNLOAD AND LINKS -->
<?php 

//See if Project already has a download sub folder
if(empty($videoData->folder_PROJECT)) { $folder = $videoData->folder_CLIENT; } else { $folder = $videoData->folder_CLIENT.'/'.$videoData->folder_PROJECT; } 


if(!empty($videoData->link_QT_VIDEO)) {
$qt_url = fileDownloadURL($videoData->link_QT_VIDEO,$folder);
if(!empty($videoData->link_QT_VIDEO) && fileDownloadCheck($qt_url)) { ?>
<li>
	 <div class="input-group">
          <span class="input-group-addon"><a href="<?php echo $qt_url; ?>" target="blank">QT</a></span>
          <input type="text" value="<?php echo $qt_url; ?>" class="form-control" onClick="SelectAll('qt-link');">
     </div>
</li>
      
<?php } else { ?><p><i class="fa fa-warning-sign"></i> QT - File not found</p><?php } } ?>


<!-- !WMV DOWNLOAD AND LINK -->
<?php if(!empty($videoData->link_WMV_VIDEO)) {

$wmv_url = fileDownloadURL($videoData->link_WMV_VIDEO,$folder);
if(!empty($videoData->link_WMV_VIDEO) && fileDownloadCheck($wmv_url)) { ?>
<li>
	 <div class="input-group">
          <span class="input-group-addon"><a href="<?php echo $wmv_url; ?>" target="blank">WMV</a></span>
          <input type="text" value="<?php echo $wmv_url; ?>" class="form-control" onClick="SelectAll('qt-link');">
     </div>
</li>
<?php } else { ?><p><i class="fa fa-warning-sign"></i> WMV - File not found</p><?php } } ?>


<!-- !FLV DOWNLOAD AND LINK -->
<?php if(!empty($videoData->link_FLV_VIDEO)) {
$flv_url = fileDownloadURL($videoData->link_FLV_VIDEO,$folder);
if(fileDownloadCheck($flv_url)) { ?>
<li>
	 <div class="input-group">
          <span class="input-group-addon"><a href="<?php echo $flv_url; ?>" target="blank">FLV</a></span>
          <input type="text" value="<?php echo $flv_url; ?>" class="form-control" onClick="SelectAll('qt-link');">
     </div>
</li>
<?php } else { ?><p><i class="fa fa-warning-sign"></i> Flash FLV - File not found</p><?php } } ?>


<!-- !OTHER DOWNLOAD AND LINK -->
<?php if(!empty($videoData->link_other_VIDEO)) {
$other_url = fileDownloadURL($videoData->link_other_VIDEO,$folder);
if(!empty($videoData->link_other_VIDEO) && fileDownloadCheck($other_url)) { ?>
<li>
	 <div class="input-group">
          <span class="input-group-addon"><a href="<?php echo $other_url; ?>" target="blank"><?php echo $videoData->link_otherLabel_VIDEO; ?></a></span>
          <input type="text" value="<?php echo $other_url; ?>" class="form-control" onClick="SelectAll('qt-link');">
     </div>
</li>
<?php } else { ?><p><i class="fa fa-warning-sign"></i> Other - File not found</p><?php } } ?>

 
</form>

<?php } else { ?>

<li>
No download links added
</li>
<?php } ?>

            </ul>
            
      <div id="sharelink" class="hidden-xs">
      <div class="input-group">
          <span class="input-group-addon">DL links</span>
	      <input type="text" value="http://kingdom-creative.co.uk/view/share/<?php echo $videoData->_kp_VIDEO?>" class="form-control" onClick="SelectAll('share-link-1');" id="share-link-1">
      </div>
	  </div>
	  
	   <div id="sharelink" class="hidden-xs">
	   <div class="input-group">
          <span class="input-group-addon">No links</span>
	       <input type="text" value="http://kingdom-creative.co.uk/view/film/<?php echo $videoData->vimeoID_VIDEO; ?>" class="form-control" onClick="SelectAll('share-link-2');" id="share-link-2">
	  </div>
	  </div>
	  
	  <?php 
							    
							    //Show Youtube Stats if applicable 
							    
							    	if($videoData->youtubeStats_PROJECT && $videoData->youtubeID_VIDEO) { 
							    	
								    $video_ID = $videoData->youtubeID_VIDEO;
								    $JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video_ID}?v=2&alt=json");
								    $JSON_Data = json_decode($JSON);
								    $views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
								    $rating = $JSON_Data->{'entry'}->{'yt$rating'}->{'numLikes'}; 
								    
								    
								    //Write back current number of YouTube views into our database
								    
								    if(!empty($views)) {
									    
									updateYoutubeViewCount($videoData->_kp_VIDEO,$views);
									    
								    } }
								    
								    
								    ?>
<?php if(!empty($videoData->youtubeStats_PROJECT) && !empty($videoData->youtubeID_VIDEO)) { ?>
       <h2>Youtube stats</h2>
<div class="span4 news-item">
  
<?php if(!empty($videoData->youtubeID_VIDEO)) { ?><span class="stats"><a href="http://www.youtube.com/watch?v=<?php echo $videoData->youtubeID_VIDEO; ?>"><i class="icon-desktop"></i> Views: <strong><?php echo number_format($views); ?></strong> l <i class="icon-thumbs-up"></i> Likes: <strong><?php echo $rating; ?></strong></a></span> <?php } ?>

</div><?php } ?>           
      </div>
            
      </div>
      
     
      
        
      </div> <!-- /ROW -->
    </div> <!-- /CONTAINER -->


<?php $relatedFilms = fetchRelatedFilms($videoData->_kp_PROJECT,$videoData->_kp_VIDEO); ?>

 <?php if($relatedFilms) { ?> 
 
   <div id="films-full">
   <h2>Other films</h2>
   <div class="row">
   
<?php $filmCounter = 1;  while ($relatedFilmData = $relatedFilms->fetch_object()) { ?>

 
   
   <!-- LOOP -->
   <div class="col-md-6 col-lg-3">
   <div class="film">
   <div class="video-wrap">
   <?php if($relatedFilmData->youtubeID_VIDEO) { ?>
   	<iframe width="730" height="410" src="http://www.youtube.com/embed/<?php echo $relatedFilmData->youtubeID_VIDEO; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
   	<?php } else { ?>
   	<iframe width="730" height="410" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen src="http://player.vimeo.com/video/<?php echo $relatedFilmData->vimeoID_VIDEO?>?title=0&amp;byline=0&amp;portrait=0&amp;color=f28c3a"></iframe>
   	<?php } ?>
   </div>
   
   <div class="video-info">
      <p class="list-text"></p><h4> <a href="/film/<?php echo $relatedFilmData->_kp_VIDEO; ?>/<?php echo titleURL($relatedFilmData->title_VIDEO); ?>"><?php echo $relatedFilmData->title_VIDEO; ?></a></h4><p></p>
       <p class="video-info-loop">
       
       <!-- Version --> <span class="version">Version <?php echo $videoData->version_VIDEO; ?></span>
      <!-- Timestamp --> <span class="time"><?php echo $relatedFilmData->added_VIDEO; ?></span>
      <!-- Password --> <?php if(!empty($relatedFilmData->password_VIDEO)) { ?><span class="password"><i class="fa fa-unlock-alt"></i><?php echo $relatedFilmData->password_VIDEO; ?></span><?php } ?>
      
      
      <?php if($projectData->youtubeStats_PROJECT || $relatedFilmData->youtubeID_VIDEO) {
	$video_ID = $relatedFilmData->youtubeID_VIDEO;
	$JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video_ID}?v=2&alt=json");
	$JSON_Data = json_decode($JSON);
	$views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
	$rating = $JSON_Data->{'entry'}->{'yt$rating'}->{'numLikes'}; 
	
	//Write back current number of YouTube views into our database
								    
	if(!empty($views)) {
									    
	updateYoutubeViewCount($videoData->_kp_VIDEO,$views); } ?>
      
      <!-- Stats --> <?php if(!empty($relatedFilmData->youtubeStats_VIDEO) && !empty($projectData->youtubeStats_PROJECT)) { ?><span class="stats"><a href="http://www.youtube.com/watch?v=<?php echo $relatedFilmData->youtubeID_VIDEO; ?>" target="blank"><i class="fa fa-youtube-play"></i><?php echo number_format($views); ?></a></span><span class="stats"><a href="http://www.youtube.com/watch?v=<?php echo $relatedFilmData->youtubeID_VIDEO; ?>" target="blank"><i class="icon-thumbs-up"></i> <i class="fa fa-thumbs-o-up"></i><?php echo $rating; ?></a></span> 
      
      
      <?php } } ?>
      
      
      </p>
       <a href="/film/<?php echo $relatedFilmData->_kp_VIDEO; ?>/<?php echo titleURL($relatedFilmData->title_VIDEO); ?>" class="btn btn-primary"><i class="fa fa-info-circle"></i> Info</a>
       <?php if($relatedFilmData->link_QT_VIDEO || $relatedFilmData->link_WMV_VIDEO || $relatedFilmData->link_FLV_VIDEO || $relatedFilmData->link_iPhone_VIDEO || $relatedFilmData->link_other_VIDEO) { ?>
       <span class="downloads-available">Downloads are available</span>
       <?php } ?>
       
       <div class="clearboth"></div>
      </div>
   
   </div>
   </div>
   
   <!-- /LOOP -->
   
   <?php if ($filmCounter == 4) { ?>
   <div class="clearboth"></div>
   <?php } ?>
   
  <?php  $filmCounter++; } // End While ?>    
      
   </div>

   </div>
   
   <?php } ?> 

<?php include('includes/footer.php'); ?>		