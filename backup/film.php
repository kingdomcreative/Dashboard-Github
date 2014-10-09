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

// Randomize background
  $bg = array('bg-01.jpg', 'bg-02.jpg', 'bg-03.jpg', 'bg-04.jpg', 'bg-05.jpg', 'bg-06.jpg', 'bg-07.jpg' ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen

?>

<!doctype html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>

  <?php include('includes/header.php'); ?> 

    
<div class="menu-header">
	<div class="container">

        <div class="span8 first">
		<h1>VIEW <span style="font-weight: 200;"><?php echo $videoData->title_VIDEO; ?></span></h1>
        </div>

        <div class="span4 staff">
        <img src="http://dashboard.circuitpro.co.uk/img/meet-<?php echo $staffData->shortname_STAFF; ?>.png">
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
  <a class="btn btn-primary edit-toggle" href="#" id="editFilm">EDIT</a><a class="btn btn-primary" href="mailto:?Subject=New Content: <?php echo $videoData->title_VIDEO; ?> updated to Version <?php echo $videoData->version_VIDEO+1; ?>" id="updateVersion" data-film="<?php echo $videoData->_kp_VIDEO; ?>">UPDATE VERSION</a>
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

<div class="span4 highlight"><h3 class="first">SHARE <span style="font-weight: 200;">LINK</span></h3></div>
<div class="span4 news-item">
<div class="news-active">
<form class="form-horizontal" enctype="multipart/form-data">
      <input type="text" value="http://circuitpro.co.uk/view/film/<?php echo $videoData->vimeoID_VIDEO?>" class="download-links-input" onClick="SelectAll('share-link');" id="share-link"> <a class="btn email-dl" href="mailto:?Subject=View Film - <?php echo $videoData->title_VIDEO; ?>&body=http://circuitpro.co.uk/view/film/<?php echo $videoData->vimeoID_VIDEO?>"><i class="icon-inbox"></i></a>
    </form>
</div></div>

<! END Link Generator !>

<!-- ------------------------------- -->

<! Download Links !>

<div class="span4 highlight"><h3 class="first">DOWNLOAD <span style="font-weight: 200;">LINKS</span></h3></div>
<div class="span4 news-item">

<?php if($videoData->link_QT_VIDEO || $videoData->link_WMV_VIDEO || $videoData->link_FLV_VIDEO || $videoData->link_iPhone_VIDEO || $videoData->link_other_VIDEO) { ?>

<div class="news-active download-links">

<form class="form-horizontal" name="viewFilmForm">

<?php if(!empty($videoData->link_QT_VIDEO)) {
$qt_url = fileDownloadURL($videoData->link_QT_VIDEO,$videoData->folder_CLIENT);
if(!empty($videoData->link_QT_VIDEO) && fileDownloadCheck($qt_url)) { ?>
<a class="btn btn-warning" href="<?php echo $qt_url; ?>">QT</a> <input type="text" value="<?php echo $qt_url; ?>" class="download-links-input" onClick="SelectAll('qt-link');" id="qt-link"> <a class="btn email-dl" href="mailto:?Subject=Download Quicktime File - <?php echo $videoData->title_VIDEO; ?>&body=<?php echo urlencode($qt_url); ?>"><i class="icon-inbox"></i></a>
<?php } else { ?><p><i class="icon-warning-sign"></i> QT - File not found</p><?php } } ?>

<?php if(!empty($videoData->link_WMV_VIDEO)) {
$wmv_url = fileDownloadURL($videoData->link_WMV_VIDEO,$videoData->folder_CLIENT);
if(!empty($videoData->link_WMV_VIDEO) && fileDownloadCheck($wmv_url)) { ?>
<a class="btn btn-warning" href="<?php echo $wmv_url; ?>">WMV</a> <input type="text" value="<?php echo $wmv_url; ?>" class="download-links-input" onClick="SelectAll('wmv-link');" id="wmv-link"> <a class="btn email-dl" href="mailto:?Subject=Download Window Media File - <?php echo $videoData->title_VIDEO; ?>&body=<?php echo urlencode($wmv_url); ?>"><i class="icon-inbox"></i></a>
<?php } else { ?><p><i class="icon-warning-sign"></i> WMV - File not found</p><?php } } ?>

<?php if(!empty($videoData->link_FLV_VIDEO)) {
$flv_url = fileDownloadURL($videoData->link_FLV_VIDEO,$videoData->folder_CLIENT);
if(fileDownloadCheck($flv_url)) { ?>
<a class="btn btn-warning" href="<?php echo $flv_url; ?>">flv</a> <input type="text" value="<?php echo $flv_url; ?>" class="download-links-input" onClick="SelectAll('flv-link');" id="flv-link"> <a class="btn email-dl" href="mailto:?Subject=Download Window Media File - <?php echo $videoData->title_VIDEO; ?>&body=<?php echo urlencode($flv_url); ?>"><i class="icon-inbox"></i></a>
<?php } else { ?><p><i class="icon-warning-sign"></i> FLV - File not found</p><?php } } ?>

<?php if(!empty($videoData->link_other_VIDEO)) {
$other_url = fileDownloadURL($videoData->link_other_VIDEO,$videoData->folder_CLIENT);
if(!empty($videoData->link_other_VIDEO) && fileDownloadCheck($other_url)) { ?>
<a class="btn btn-warning" href="<?php echo $other_url; ?>"><?php echo $videoData->link_otherLabel_VIDEO; ?></a> <input type="text" value="<?php echo $other_url; ?>" class="download-links-input" onClick="SelectAll('other-link');" id="other-link"> <a class="btn email-dl" href="mailto:?Subject=Download Window Media File - <?php echo $videoData->title_VIDEO; ?>&body=<?php echo urlencode($other_url); ?>"><i class="icon-inbox"></i></a>
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

<!-- ------------------------------- -->


  </div>
  </div>
  </div> 
  <! END FILM BLOCK !>
  
 
   <! EDIT VIDEO BLOCK !>
<div class="fold-full" style="display: none;">
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
  
</div>
<! END Breadcrumbs !>

<!-- ------------------------------- -->

<! Editing Video !>

<div class="span8 video-item">

<div class="news-active download-links">

<div class="filmEditForm">
<form class="form-horizontal" id="filmUpdate" method="post" action="/ajax/update_film.php" enctype="multipart/form-data" name="editFilmForm">

<input type="hidden" value="<?php echo $videoData->_kp_VIDEO; ?>" name="filmID">
Title: <input type="text" value="<?php echo $videoData->title_VIDEO; ?>" class="download-links-input" id="form-title" name="filmTitle"><br/>

Vimeo ID: <input type="text" value="<?php echo $videoData->vimeoID_VIDEO; ?>" class="download-links-input" onClick="SelectAll('form-vimeo');" id="form-vimeo" name="vimeoID"><br/>

YouTube ID: <input type="text" value="<?php echo $videoData->youtubeID_VIDEO; ?>" class="download-links-input" onClick="SelectAll('form-youtube');" id="form-youtube" name="youtubeID"><br/>

YouTube Stats: <?php if (empty($videoData->youtubeStats_VIDEO)) { ?>
        <input name="youtubeStats" type="checkbox" value="0" /><?php } else { ?>
        <input name="youtubeStats" type="checkbox" value="1" checked="yes" /><?php } ?><br />
        
Quicktime Download: <input type="text" value="<?php echo $videoData->link_QT_VIDEO; ?>" class="download-links-input" name="curr_qt_file" readonly><input type="file" class="uploadButton" name="qt_file"><br/>

WMV Download: <input type="text" value="<?php echo $videoData->link_WMV_VIDEO; ?>" class="download-links-input" name="curr_wmv_file" readonly><input type="file" name="wmv_file"><br/>

FLV Download: <input type="text" value="<?php echo $videoData->link_FLV_VIDEO; ?>" class="download-links-input" name="curr_flv_file" readonly><input type="file" name="flv_file"><br/>

Other Download: <input type="text" value="<?php echo $videoData->link_otherLabel_VIDEO; ?>" class="download-links-input"><input type="other_file_label" value="<?php echo $videoData->link_other_VIDEO; ?>" class="download-links-input" name="curr_other_file"readonly><input type="file" name="other_file"><br/>


<input type="submit" class="btn btn-success form-sub" value="SAVE CHANGES">

</form>
</div> <!-- End filmEditForm -->

<div class="filmEditFormDone" style="display:none;">

<div class="alert alert-success"><?php echo $videoData->title_VIDEO; ?> Updated</div>


<a class="btn btn-success" href="/film/<?php echo $videoData->_kp_VIDEO; ?>/<?php echo titleURL($videoData->title_VIDEO); ?>" id="updateFilm">RELOAD PAGE</a>

</div> <!-- End filmEditFormDone -->


</div>


  </div> 
  </div>
  
  <! END EDIT VIDEO BLOCK !> 

 

</div><!-- END Container -->
</div>

<! Related Films !>

<?php $relatedFilms = fetchRelatedFilms($videoData->_kp_PROJECT,$videoData->_kp_VIDEO); ?>

<div class="tab-full">
<div class="container related-films">
    <div class="row">
     <div class="span12">
<h2 class="sub-title">RELATED <span style="font-weight: 200;">FILMS</span></h2>

<ul>
<?php while ($relatedFilmData = $relatedFilms->fetch_object()) { ?>

<li><a href="/film/<?php echo $relatedFilmData->_kp_VIDEO; ?>/<?php echo titleURL($relatedFilmData->title_VIDEO); ?>"><?php echo $relatedFilmData->title_VIDEO; ?></a></li>
	
	
<?php } ?>

</ul>

</div>


    </div>

<! END Related Films !>
  
  






</body>

</html>
		
