<?php 

include ('db.php');
include ('functions.php');

//Check if user is logged in first
	if (!checkStaffLoggedIn()) {
	header("Location: http://dashboard.circuitpro.co.uk"); }
	
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

<!--

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

    
<div class="menu-header">
	<div class="container">

        <div class="span8 first">
		<h1>VIEW <span style="font-weight: 200;"><?php echo $videoData->title_VIDEO; ?></span></h1>
        </div>

        <div class="span4 staff">
        <img src="http://dashboard.circuitpro.co.uk/img/meet-<?php echo $staffData->username_STAFF; ?>.png">
        </div>

	</div>
</div>


<! Header Options !>
<div class="header-full">
<div class="container header-option">
	    <div class="row">


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
        <li><a href="/client/<?php echo $videoData->_kp_CLIENT; ?>/<?php echo $videoData->username_CLIENT; ?>"><?php echo $videoData->name_CLIENT; ?></a> <span class="divider">/</span></li>
        <li><a href="/project/<?php echo $videoData->_kp_PROJECT; ?>/<?php echo titleURL($videoData->title_PROJECT); ?>"><?php echo $videoData->title_PROJECT; ?></a> <span class="divider">/</span></li>
        <li class="active"><a href="/film/<?php echo $videoData->_kp_VIDEO; ?>/<?php echo titleURL($videoData->title_VIDEO); ?>"><?php echo $videoData->title_VIDEO; ?></a> - Version: <?php echo $videoData->version_VIDEO; ?></li>
        </ul>
      </div>

<div class="span4 edit">

<div id="updateFilmVersion">
  <a class="btn btn-primary edit-toggle" href="#" id="editFilm">EDIT</a>
  <!-- <a class="btn btn-success" href="mailto:?Subject=New Content: <?php echo $videoData->title_VIDEO; ?> updated to Version <?php echo $videoData->version_VIDEO+1; ?>" id="updateVersion" data-film="<?php echo $videoData->_kp_VIDEO; ?>">UPDATE VERSION</a> -->
</div>

</div>
<! END Breadcrumbs !>

<!-- ------------------------------- -->

<! VIDEO DETAIL !>

<div class="span8 video-item">

<?php if($videoData->youtubeID_VIDEO) { ?>
<iframe width="730" height="410" src="//www.youtube.com/embed/<?php echo $videoData->youtubeID_VIDEO; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
<?php } else { ?>
<iframe width="730" height="410" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen src="http://player.vimeo.com/video/<?php echo $videoData->vimeoID_VIDEO?>?title=0&amp;byline=0&amp;portrait=0&amp;color=f28c3a"></iframe>
<?php } ?>




</div>

<! END VIDEO DETAIL !>

<!-- ------------------------------- -->

<! Link Generator !>

<div class="span4"><h3 class="first">SHARE <span style="font-weight: 200;">LINK</span></h3></div>
<div class="span4 news-item">
<div class="share-link">
<form class="form-horizontal" enctype="multipart/form-data">
      <input type="text" value="http://kingdom-creative.co.uk/view/share/<?php echo $videoData->_kp_VIDEO?>" class="share-links-input" onClick="SelectAll('share-link');" id="share-link"> <a class="btn email-dl" title="Email Link" href="mailto:?Subject=View Film - <?php echo $videoData->title_VIDEO; ?>&body=http://kingdom-creative.co.uk/view/share/<?php echo $videoData->_kp_VIDEO?>"><i class="icon-inbox"></i></a>
    </form>
</div></div>

<! END Link Generator !>

<!-- ------------------------------- -->

<! Download Links !>

<div class="span4 highlight"><h3 class="first">DOWNLOAD <span style="font-weight: 200;">LINKS</span></h3></div>
<div class="span4 news-item">

<?php if($videoData->link_QT_VIDEO || $videoData->link_WMV_VIDEO || $videoData->link_FLV_VIDEO || $videoData->link_iPhone_VIDEO || $videoData->link_other_VIDEO) { ?>

<div class="download-links">

<form class="form-horizontal" name="viewFilmForm">


<!-- !FILE DOWNLOAD AND LINKS -->
<?php 

//See if Project already has a download sub folder
if(empty($videoData->folder_PROJECT)) { $folder = $videoData->folder_CLIENT; } else { $folder = $videoData->folder_CLIENT.'/'.$videoData->folder_PROJECT; }


if(!empty($videoData->link_QT_VIDEO)) {
$qt_url = fileDownloadURL($videoData->link_QT_VIDEO,$folder);
if(!empty($videoData->link_QT_VIDEO) && fileDownloadCheck($qt_url)) { ?>
<a class="btn btn-warning" href="<?php echo $qt_url; ?>">QT</a> <input type="text" value="<?php echo $qt_url; ?>" class="download-links-input" onClick="SelectAll('qt-link');" id="qt-link"> <!-- <a class="btn email-dl" title="Email Link" href="mailto:?Subject=Download Quicktime File - <?php echo $videoData->title_VIDEO; ?>&body=<?php echo urlencode($qt_url); ?>"><i class="icon-inbox"></i></a> -->
<?php } else { ?><p><i class="icon-warning-sign"></i> QT - File not found</p><?php } } ?>


<!-- !WMV DOWNLOAD AND LINK -->
<?php if(!empty($videoData->link_WMV_VIDEO)) {

$wmv_url = fileDownloadURL($videoData->link_WMV_VIDEO,$folder);
if(!empty($videoData->link_WMV_VIDEO) && fileDownloadCheck($wmv_url)) { ?>
<a class="btn btn-warning" href="<?php echo $wmv_url; ?>">WMV</a> <input type="text" value="<?php echo $wmv_url; ?>" class="download-links-input" onClick="SelectAll('wmv-link');" id="wmv-link"> <!-- <a class="btn email-dl" title="Email Link" href="mailto:?Subject=Download Window Media File - <?php echo $videoData->title_VIDEO; ?>&body=<?php echo urlencode($wmv_url); ?>"><i class="icon-inbox"></i></a> -->
<?php } else { ?><p><i class="icon-warning-sign"></i> WMV - File not found</p><?php } } ?>


<!-- !FLV DOWNLOAD AND LINK -->
<?php if(!empty($videoData->link_FLV_VIDEO)) {
$flv_url = fileDownloadURL($videoData->link_FLV_VIDEO,$folder);
if(fileDownloadCheck($flv_url)) { ?>
<a class="btn btn-warning" href="<?php echo $flv_url; ?>">Flash FLV</a> <input type="text" value="<?php echo $flv_url; ?>" class="download-links-input" onClick="SelectAll('flv-link');" id="flv-link"> <!-- <a class="btn email-dl" title="Email Link" href="mailto:?Subject=Download Window Media File - <?php echo $videoData->title_VIDEO; ?>&body=<?php echo urlencode($flv_url); ?>"><i class="icon-inbox"></i></a> -->
<?php } else { ?><p><i class="icon-warning-sign"></i> Flash FLV - File not found</p><?php } } ?>


<!-- !OTHER DOWNLOAD AND LINK -->
<?php if(!empty($videoData->link_other_VIDEO)) {
$other_url = fileDownloadURL($videoData->link_other_VIDEO,$folder);
if(!empty($videoData->link_other_VIDEO) && fileDownloadCheck($other_url)) { ?>
<a class="btn btn-warning" href="<?php echo $other_url; ?>"><?php echo $videoData->link_otherLabel_VIDEO; ?></a> <input type="text" value="<?php echo $other_url; ?>" class="download-links-input" onClick="SelectAll('other-link');" id="other-link"> <!-- <a class="btn email-dl" title="Email Link" href="mailto:?Subject=Download Window Media File - <?php echo $videoData->title_VIDEO; ?>&body=<?php echo urlencode($other_url); ?>"><i class="icon-inbox"></i></a> -->
<?php } else { ?><p><i class="icon-warning-sign"></i> Other - File not found</p><?php } } ?>

 
</form>
</div>

<?php } else { ?>

<div class="news-active download-links">
<p>No Download Links added</p>
</div>
<?php } ?>

</div>

<! END Download Links !>

<!-- YOUTUBE STATS -->
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
<div class="span4 highlight"><h3 class="first">YOUTUBE <span style="font-weight: 200;">STATS</span></h3></div>
<div class="span4 news-item">
  
<?php if(!empty($videoData->youtubeID_VIDEO)) { ?><span class="stats"><a href="http://www.youtube.com/watch?v=<?php echo $videoData->youtubeID_VIDEO; ?>"><i class="icon-desktop"></i> Views: <strong><?php echo number_format($views); ?></strong> l <i class="icon-thumbs-up"></i> Likes: <strong><?php echo $rating; ?></strong></a></span> <?php } ?>

</div><?php } ?>

<!-- ------------------------------- -->


  </div>
  </div>
  </div> 
  <! END FILM BLOCK !>
  
 
   <!----------------------------- EDIT VIDEO  ------------------------------>
<div class="fold-full edit-film tab-edit edit-rev" style="display: none;">
<div class="container">
	    <div class="row">



<!-- ------------------------------- -->

<! Editing Video !>
<form class="form-horizontal" id="filmUpdate" method="post" action="/ajax/update_film.php" enctype="multipart/form-data" name="editFilmForm">
  <div class="span12"><h2 class="sub-title">EDIT </h2><input type="text" name="filmTitle" value="<?php echo $videoData->title_VIDEO; ?>" class="add-form edit-film-title"> 
    <div class="action-filter">Version: <select name="version" class="">
    
    <?php $versionCounter = $videoData->version_VIDEO; 
    
    while ($versionCounter <= 8) {
    
    printf('<option value ="%d">%d</option>',$versionCounter,$versionCounter); 
    
    $versionCounter++; } ?>

</select></div></div>
<div class="clearboth"></div>

<?php if(!empty($videoData->viewingNotes_CLIENT)) { ?><div class="span12"><div class="alert"><i class="icon-bell"></i> CLIENT DELIVERY: <?php echo $videoData->viewingNotes_CLIENT; ?></div></div><?php } ?>

<div class="span12 edit-film-info">

<div class="news-active download-links">

<div class="filmEditForm">

<input type="hidden" value="<?php echo $videoData->_kp_VIDEO; ?>" name="filmID">
<input type="hidden" value="<?php echo $videoData->folder_CLIENT; ?>" name="clientFolder">
<input type="hidden" value="<?php echo $staffData->shortname_STAFF; ?>" name="updatedBy">
<input type="hidden" value="<?php echo $videoData->_kf_staff_prodManager_PROJECT; ?>" name="prodMgrID">

<div class="row-fluid">

<div class="span5">
<p>Vimeo:  <input type="text" value="<?php echo $videoData->vimeoID_VIDEO; ?>" onClick="SelectAll('form-vimeo');" id="form-vimeo" name="vimeoID"><?php if(!empty($videoData->vimeoID_VIDEO)) { ?>
<a href="https://vimeo.com/<?php echo $videoData->vimeoID_VIDEO; ?>/settings/file" target="_blank" class="btn btn-warning"><i class="icon-share-sign"></i></a><?php } ?></p>
</div>


<div class="span4">
<p>YouTube:  <input type="text" value="<?php echo $videoData->youtubeID_VIDEO; ?>" onClick="SelectAll('form-youtube');" id="form-youtube" name="youtubeID"><?php if(!empty($videoData->youtubeID_VIDEO)) { ?>
<a href="http://www.youtube.com/watch?v=<?php echo $videoData->youtubeID_VIDEO; ?>" target="_blank" class="btn btn-warning"><i class="icon-share-sign"></i></a><?php } ?></p>
</div>


<div class="span3">
  Show YouTube Stats: 
<?php if (empty($videoData->youtubeStats_VIDEO)) { ?>
        <input name="youtubeStats" type="checkbox" value="1" /><?php } else { ?>
        <input name="youtubeStats" type="checkbox" value="1" checked="yes" /><?php } ?>
</div>

<div class="clearboth"></div>
<div class="row-fluid"> 

<div class="span2">     
<p>Quicktime Download: </p>
</div>
<div class="span10">  
<input type="text" value="<?php echo $videoData->link_QT_VIDEO; ?>" class="unedit" name="curr_qt_file" readonly><input type="file" name="qt_file">
<?php if(!empty($videoData->link_QT_VIDEO))  printf('<a class="btn btn-danger" href="/ajax/delete_film_link.php?film=%d&film_title=%s&type=QT&clientFolder=%s" onClick="return confirmDeleteLink()"><i class="icon-trash"></i></a>',$videoData->_kp_VIDEO,titleURL($videoData->title_VIDEO),$videoData->folder_CLIENT); ?>
</div>
<div class="clearboth"></div>
<div class="span2 first">     
<p>WMV Download: </p>
</div>
<div class="span10">
<input type="text" value="<?php echo $videoData->link_WMV_VIDEO; ?>" class="unedit" name="curr_wmv_file" readonly><input type="file" name="wmv_file">
<?php if(!empty($videoData->link_WMV_VIDEO))  printf('<a class="btn btn-danger" href="/ajax/delete_film_link.php?film=%d&film_title=%s&type=WMV&clientFolder=%s" onClick="return confirmDeleteLink()"><i class="icon-trash"></i></a>',$videoData->_kp_VIDEO,titleURL($videoData->title_VIDEO),$videoData->folder_CLIENT); ?>
</div>
<div class="clearboth"></div>
<div class="span2 first">     
<p>FLV Download: </p>
</div>
<div class="span10">
<input type="text" value="<?php echo $videoData->link_FLV_VIDEO; ?>" class="unedit" name="curr_flv_file" readonly><input type="file" name="flv_file">
<?php if(!empty($videoData->link_FLV_VIDEO))  printf('<a class="btn btn-danger" href="/ajax/delete_film_link.php?film=%d&film_title=%s&type=FLV&clientFolder=%s" onClick="return confirmDeleteLink()"><i class="icon-trash"></i></a>',$videoData->_kp_VIDEO,titleURL($videoData->title_VIDEO),$videoData->folder_CLIENT); ?>
</div>
<div class="clearboth"></div>
<div class="span2 first"> 
<p>Other Download: </p>
</div>
<div class="span10">
<input type="text" value="<?php echo $videoData->link_otherLabel_VIDEO; ?>" class="unedit"name="other_file_label"><input type="text" class="unedit" value="<?php echo $videoData->link_other_VIDEO; ?>" name="curr_other_file"readonly><input type="file" name="other_file">
<?php if(!empty($videoData->link_other_VIDEO))  printf('<a class="btn btn-danger" href="/ajax/delete_film_link.php?film=%d&film_title=%s&type=Other&clientFolder=%s" onClick="return confirmDeleteLink()"><i class="icon-trash"></i></a>',$videoData->_kp_VIDEO,titleURL($videoData->title_VIDEO),$videoData->folder_CLIENT); ?>
</div>

</div>

<input type="submit" class="btn btn-success form-sub" value="SAVE CHANGES">

<a class="btn btn-warning edit-toggle" href="#" id="cancelEdit">CANCEL</a>


<?php printf('<a class="btn btn-danger" href="/ajax/delete_film.php?film=%d&project=%d&project_title=%s" id="deteleFilm" onClick="return confirmDeleteFilm(\'%s\')">DELETE</a>',$videoData->_kp_VIDEO,$videoData->_kp_PROJECT,titleURL($videoData->title_PROJECT),$videoData->title_VIDEO); ?>


</form>
</div> <!-- End filmEditForm -->



<div class="filmEditFormDone" style="display:none;">

<div class="alert alert-success">Film Details Updated</div>

<a class="btn btn-warning" href="/film/<?php echo $videoData->_kp_VIDEO; ?>/<?php echo titleURL($videoData->title_VIDEO); ?>">REFRESH</a>


</div> <!-- End filmEditFormDone -->


</div>


  </div> 
  </div>
  
  <! END EDIT VIDEO BLOCK !> 

 

</div><!-- END Container -->
</div>
</div>

<! Related Films !>

<?php $relatedFilms = fetchRelatedFilms($videoData->_kp_PROJECT,$videoData->_kp_VIDEO); ?>

<?php if($relatedFilms) { ?> 

<div class="tab-full">
<div class="container">
    <div class="row">
     <div class="span12">
<h2 class="sub-title related">RELATED <span style="font-weight: 200;">FILMS</span></h2>
<div class="clearboth"></div>
<ul class="list-projects">
<?php while ($relatedFilmData = $relatedFilms->fetch_object()) { ?>

<li class="related-films"><a href="/film/<?php echo $relatedFilmData->_kp_VIDEO; ?>/<?php echo titleURL($relatedFilmData->title_VIDEO); ?>"><?php echo $relatedFilmData->title_VIDEO; ?></a></li>
	
	
<?php } ?>

</ul>

</div>

    </div>
    <?php } ?>

<! END Related Films !>
  
  






</body>

</html>
		
