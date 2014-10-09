<?php 

include ('db.php');
include ('functions.php');

//Check if user is logged in first
	if (!checkStaffLoggedIn()) {
	header("Location: index.php"); }
	
//Then fetch the staff record from cookie or session variable
	if(isset($_COOKIE['staff-ID'])) {
	$staffData = fetchStaffviaID($_COOKIE['staff-ID']); } else {
	$staffData = fetchStaffviaID($_SESSION['staff-ID']);
	}

	$localPage="clipboard";
	
	$clipboardData = fetchClipboardData();

?>

<!doctype html>
<html lang="en">

<?php include('includes/head.php'); ?>
<body>

  <?php include('includes/header.php'); ?> 

<div class="menu-header">
	<div class="container">

        <div class="span8 first">
		<h1>THE <span style="font-weight: 200;">CLIPBOARD</span></h1>
        </div>

        <div class="span4 staff">
        <img src="img/meet-<?php echo $staffData->shortname_STAFF; ?>.png">
        </div>

	</div>
</div>

 
<! Header Options !>
<div class="header-full">

<div class="span4 edit">

<div id="addToClipboard">
  <a class="btn btn-success edit-toggle" href="#" id="editFilm">ADD TO CLIPBOARD</a>
  <!-- <a class="btn btn-success" href="mailto:?Subject=New Content: <?php echo $videoData->title_VIDEO; ?> updated to Version <?php echo $videoData->version_VIDEO+1; ?>" id="updateVersion" data-film="<?php echo $videoData->_kp_VIDEO; ?>">UPDATE VERSION</a> -->
</div>

</div>

</div>



   <!----------------------------- !ADD TO CLIPBOARD  ------------------------------>
<div class="fold-full edit-film tab-edit edit-rev" >
<div class="container">
	    <div class="row">
		    
		    <form class="form-horizontal" id="addClipboard" method="post" action="/ajax/add_clipboard.php" enctype="multipart/form-data" name="addClipboard">
		    
		 <input type="hidden" value="<?php echo $staffData->_kp_STAFF; ?>" name="staff">
		 <input type="hidden" value="<?php echo $staffData->shortname_STAFF; ?>" name="addedBy">
		    
		<div class="span5">
		<p>Title:  <input type="text" value="" id="form-title" name="title" maxlength="64" /></p>
		</div>
		<div class="span5">
		<p>Link:  <input type="text" value="" id="form-link" name="link" /></p>
		</div>
		
		<div class="span5">
		<p>Notes:  <input type="text" value="" id="form-notes" name="notes" maxlength="500" /></p>
		</div>
		
		<div class="span5">
		<p>Type:  <select name="category" class="">
			<option value ="Filming Techniques">Filming Techniques</option>
			<option value ="Tutorials">Tutorials</option>
			<option value ="Aerial">Aerial</option>
			<option value ="Training Films">Training Films</option>
			<option value ="Inspirational - Cars">Inspirational - Cars</option>
			<option value ="Inspirational - Sports">Inspirational - Sports</option>
			<option value ="Inspirational - Other">Inspirational - Other</option>
			<option value ="Interviews">Interviews</option>
		</select></p>
		</div>
		
		<input type="submit" class="btn btn-success form-sub" value="ADD TO CLIPBOARD">
		    
		    </form>
		    
	    </div></div>


<div class="tab-full">
<div class="container">
    <div class="row">

<?php while ($clipboardItem = $clipboardData->fetch_object()) { ?>



<div class="span4">
<div class="clip-item">

<?php if(!empty($clipboardItem->url_CLIPBOARD)) { 
	
	// IF it is just a link with no video
	
?>
<h4><a href="<?php echo $clipboardItem->url_CLIPBOARD; ?>" target="blank"><?php echo $clipboardItem->title_CLIPBOARD; ?></a></h4>
<a href="<?php echo $clipboardItem->url_CLIPBOARD; ?>" target="blank">View link</a>

<?php } else if(!empty($clipboardItem->youtubeID_CLIPBOARD)) {

	//If it is a YouTube Video
 ?>
<h4><?php echo $clipboardItem->title_CLIPBOARD; ?></h4>
<iframe width="330" height="186" src="http://www.youtube.com/embed/<?php echo $clipboardItem->youtubeID_CLIPBOARD; ?>?rel=0" frameborder="0" allowfullscreen></iframe>

<?php } else if(!empty($clipboardItem->vimeoID_CLIPBOARD)) { 
	
	//It's a vimeo Video
?>

<h4><?php echo $clipboardItem->title_CLIPBOARD; ?></h4>
<iframe width="330" height="186" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen src="http://player.vimeo.com/video/<?php echo $clipboardItem->vimeoID_CLIPBOARD; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=f28c3a"></iframe>
<?php }  ?>


	<p>Posted by <?php echo $clipboardItem->shortname_STAFF.' on '.$clipboardItem->date_CLIPBOARD; ?> in <?php echo $clipboardItem->category_CLIPBOARD; ?></p>
	
	<p>&nbsp;</p>
	<p><?php print $clipboardItem->notes_CLIPBOARD; ?></p>
</div>
</div> <!-- /CLIP ITEM -->
<?php } /*End while*/ ?>


    </div>
</div><!-- END Container -->
</div>




</body>

</html>
		
